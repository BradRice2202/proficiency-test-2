const url = new URL(window.location.href);

if(url.searchParams.has('csv')){
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById('createCsvBtn').setAttribute('style', 'display:none !important');
        document.getElementById('createCsvBtn').style.margin = '0';
        document.getElementById('download-csv-btn').style.visibility = 'visible';
        document.getElementById('download-csv-btn').style.display = 'flex';
        document.getElementById('resetBtn').style.visibility = 'visible';
        document.getElementById('resetBtn').style.display = 'flex';
        document.getElementById('amtOfInputs').setAttribute('style', 'display:none !important');
        document.getElementById('amtOfInputs').innerHTML = '';
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const displayAmt = urlParams.get('csv');
        document.getElementById('amtOfRecordsCreatedLbl').innerHTML = displayAmt+" Records created.";
        document.getElementById('recordsInput').setAttribute('style', 'display:none !important');
        document.getElementById('amtOfInputsLbl').setAttribute('style', 'display:none !important');
        
    });
};

if(url.searchParams.has('db')){
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById('dbSuccess').style.visibility = 'visible';
        document.getElementById('dbSuccess').style.display ="block";

        document.getElementById('amtOfInputs').innerHTML = 'Added to database click redo to reset all data and try again!';

        document.getElementById('amtOfRecordsCreatedLbl').innerHTML = 'Data added to database';

        document.getElementById('createCsvBtn').setAttribute('style', 'display:none !important');

        document.getElementById('uploadCsvBtn').setAttribute('style', 'display:none !important');

        document.getElementById('resetBtn').style.visibility = 'visible';
        document.getElementById('resetBtn').style.display = 'flex';

        document.getElementById('recordsInput').setAttribute('style', 'display:none !important');
        document.getElementById('amtOfInputsLbl').setAttribute('style', 'display:none !important');

    });
};

function hideDownloadBtn(){
    document.getElementById('download-csv-btn').setAttribute('style', 'display:none !important');
}
