
function openBulkConvertPopup() {
    document.getElementById('bulkconvertcontent').innerHTML = '<div>Receiving list of files to convert...</div>';
    tb_show('Bulk Convert', '#TB_inline?inlineId=bulkconvertpopup');

    var data = {
		'action': 'list_unconverted_files',
		//'whatever': ajax_object.we_value      // We pass php values differently!
	};
    jQuery.post(ajaxurl, data, function(response) {
        var bulkInfo = {
            'groups': JSON.parse(response),
            'groupPointer': 0,
            'filePointer': 0,
            'paused': false,
            'webpTotalFilesize': 0,
            'orgTotalFilesize': 0,
        };
        window.webpexpress_bulkconvert = bulkInfo;

        // count files
        var numFiles = 0;
        for (var i=0; i<bulkInfo.groups.length; i++) {
            numFiles += bulkInfo.groups[i].files.length;
        }

        //console.log(JSON.parse(response));
        var html = '';
        if (numFiles == 0) {
            html += '<p>There are no unconverted files</p>';
        } else {
            html += '<div>'
            html += '<p>There are ' + numFiles + ' unconverted files.</p>';
            html += '<p><i>Note that in a typical setup, you will have redirect rules which triggers conversion when needed, ' +
                    'and thus you have no need for bulk conversion. In fact, in that case, you should probably not bulk convert ' +
                    'because bulk conversion will also convert images and thumbnails which are not in use, and thus take up ' +
                    'more disk space than neccessary. The bulk conversion feature was only added in order to make the plugin usable even when ' +
                    'there is problems with redirects (ie on Nginx in case you do not have access to the config or on Microsoft IIS). ' +
                    '</i></p><br>';
            html += '<button onclick="startBulkConversion()" class="button button-primary" type="button">Start conversion</button>';
            html += '</div>';
        }
        document.getElementById('bulkconvertcontent').innerHTML = html;
    });
}

function pauseBulkConversion() {
    var bulkInfo = window.webpexpress_bulkconvert;
    bulkInfo.paused = true;
}

function pauseOrResumeBulkConversion() {
    var bulkInfo = window.webpexpress_bulkconvert;
    bulkInfo.paused = !bulkInfo.paused;

    document.getElementById('bulkPauseResumeBtn').innerText = (bulkInfo.paused ? 'Resume' : 'Pause');

    if (!bulkInfo.paused) {
        convertNextInBulkQueue();
    }
}

function startBulkConversion() {
    var html = '<br>';
    html += '<style>' +
        '.has-tip {cursor:pointer; position:relative;}\n' +
        '.has-tip .tip {display: none}\n' +
        '.has-tip:hover .tip {display: block}\n' +
        '.tip{padding: 5px 10px; background-color:#ff9;position:absolute; right: 0; min-width:110px; font-size:10px; color: black; border:1px solid black; max-width:90%;z-index:10}\n' +
        '.reduction {float:right;}\n' +
        '</style>';
    html += '<button id="bulkPauseResumeBtn" onclick="pauseOrResumeBulkConversion()" class="button button-primary" type="button">Pause</button>';
    html += '<div id="bulkconvertlog"></div>';
    document.getElementById('bulkconvertcontent').innerHTML = html;

    convertNextInBulkQueue();
}

function convertDone() {
    var bulkInfo = window.webpexpress_bulkconvert;
    document.getElementById('bulkconvertlog').innerHTML += '<p><b>Done!</b></p>' +
        '<p>Total reduction: ' + getReductionHtml(bulkInfo['orgTotalFilesize'], bulkInfo['webpTotalFilesize'], 'Total size of converted originals', 'Total size of converted webp files') + '</p>'

    document.getElementById('bulkPauseResumeBtn').style.display = 'none';
}

function getPrintableSizeInfo(orgSize, webpSize) {
    if (orgSize < 10000) {
        return {
            'org': orgSize + ' bytes',
            'webp': webpSize + ' bytes'
        };
    } else {
        return {
            'org': Math.round(orgSize / 1024) + ' kb',
            'webp': Math.round(webpSize / 1024) + ' kb'
        };
    }
}

function getReductionHtml(orgSize, webpSize, sizeOfOriginalText, sizeOfWebpText) {
    var reduction = Math.round((orgSize - webpSize)/orgSize * 100);
    var sizeInfo = getPrintableSizeInfo(orgSize, webpSize);
    var hoverText = sizeOfOriginalText + ': ' + sizeInfo['org'] + '.<br>' + sizeOfWebpText + ': ' + sizeInfo['webp'];
    return '<span class="has-tip reduction">' + reduction + '%' +
        '<span class="tip">' + hoverText + '</span>' +
    '</span><br>';
}

function logLn() {
    var html = '';
    for (i = 0; i < arguments.length; i++) {
        html += arguments[i];
    }
    var spanEl = document.createElement('span');
    spanEl.innerHTML = html;

    document.getElementById('bulkconvertlog').appendChild(spanEl);

    //document.getElementById('bulkconvertlog').innerHTML += html;
}

function convertNextInBulkQueue() {
    var html;
    var bulkInfo = window.webpexpress_bulkconvert;
    //console.log('convertNextInBulkQueue', bulkInfo);

    // Current group might contain 0, - skip if that is the case
    while ((bulkInfo.groupPointer < bulkInfo.groups.length) && (bulkInfo.filePointer >= bulkInfo.groups[bulkInfo.groupPointer].files.length)) {
        logLn(
            '<h3>' + bulkInfo.groups[bulkInfo.groupPointer].groupName + '</h3>',
            '<p>Nothing to convert</p>'
        );

        bulkInfo.groupPointer++;
        bulkInfo.filePointer = 0;
    }

    if (bulkInfo.groupPointer >= bulkInfo.groups.length) {
        convertDone();
        return;
    }

    var group = bulkInfo.groups[bulkInfo.groupPointer];
    var filename = group.files[bulkInfo.filePointer];

    if (bulkInfo.filePointer == 0) {
        logLn('<h3>' + group.groupName + '</h3>');
    }

    logLn('Converting <i>' + filename + '</i>');

    var data = {
		'action': 'convert_file',
        'filename': group.root + '/' + filename

		//'whatever': ajax_object.we_value      // We pass php values differently!
    };

    function responseCallback(response){
        var result = typeof response.requestError !== 'boolean' ? JSON.parse(response) : {
            success: false,
            msg: '',
            log: '',
        };

        var bulkInfo = window.webpexpress_bulkconvert;
        var group = bulkInfo.groups[bulkInfo.groupPointer];

        var result = JSON.parse(response);
        //console.log(result);

        var html = '';
        if (result['success']) {

            var orgSize = result['filesize-original'];
            var webpSize = result['filesize-webp'];
            var orgSizePrint, webpSizePrint;

            bulkInfo['orgTotalFilesize'] += orgSize;
            bulkInfo['webpTotalFilesize'] += webpSize;

            html += ' <span style="color:green">ok</span></span>' +
                getReductionHtml(orgSize, webpSize, 'Size of original', 'Size of webp')

            //html += ' <span style="color:green" class="has-tip">ok<span class="tip">' + result['log'] + '</span></span>' +
            //    getReductionHtml(orgSize, webpSize, 'Size of original', 'Size of webp')
        } else {
            html += ' <span style="color:red">failed</span><br>';
            if (result['msg'] != '') {
                html += ' <span style="">' + result['msg'] + '</span>';
            }
            if (result['log'] != '') {
                html += ' <span style="font-size:10px">' + result['log'] + '</span>';
            }
        }
        logLn(html);


        // Get next
        bulkInfo.filePointer++;
        if (bulkInfo.filePointer == group.files.length) {
            bulkInfo.filePointer = 0;
            bulkInfo.groupPointer++;
        }
        if (bulkInfo.groupPointer == bulkInfo.groups.length) {
            convertDone();
        } else {
            if (bulkInfo.paused) {
                document.getElementById('bulkconvertlog').innerHTML += '<p><i>on pause</i><br>' +
                    'Reduction this far: ' + getReductionHtml(bulkInfo['orgTotalFilesize'], bulkInfo['webpTotalFilesize'], 'Total size of originals this far', 'Total size of webp files this far') + '</p>'

                bulkInfo['orgTotalFilesize'] += orgSize;
                bulkInfo['webpTotalFilesize'] += webpSize;

            } else {
                convertNextInBulkQueue();
            }
        }

    }

    // jQuery.post(ajaxurl, data, responseCallback);
    jQuery.ajax({
        method: 'POST',
        url: ajaxurl,
        data: data,
        success: (response) => {
            responseCallback(response);
        },
        error: () => {
            responseCallback({requestError: true});
        },
    });
}



//alert('bulk');
/*
jQuery(document).ready(function($) {
});
*/
