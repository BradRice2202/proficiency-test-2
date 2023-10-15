const url = new URL(window.location.href);

if(url.searchParams.has('csv')){
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById('createCsvBtn').setAttribute('style', 'display:none !important');
        document.getElementById('createCsvBtn').style.margin = '0';
        document.getElementById('download-csv-btn').style.visibility = 'visible';
        document.getElementById('download-csv-btn').style.display = 'flex';
        document.getElementById('resetBtn').style.visibility = 'visible';
        document.getElementById('resetBtn').style.display = 'flex';
    });
};

if(url.searchParams.has('db')){
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById('dbSuccess').style.visibility = 'visible';
        document.getElementById('dbSuccess').style.display ="block";

        document.getElementById('createCsvBtn').setAttribute('style', 'display:none !important');

        document.getElementById('uploadCsvBtn').setAttribute('style', 'display:none !important');

        document.getElementById('resetBtn').style.visibility = 'visible';
        document.getElementById('resetBtn').style.display = 'flex';

    });
};

function hideDownloadBtn(){
    document.getElementById('download-csv-btn').setAttribute('style', 'display:none !important');
}
