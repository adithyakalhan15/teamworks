<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/javascript');
?>

//variables
var outputConsole, btnRun, btnLoad, inputTestFile, testArray;

class MyConsole{
    constructor(e){
        this.e = e;
    }
    
    clear = ()=>{
        this.e.innerHTML = "";
    }

    log = (message)=>{
        if (typeof(message) === "object"){
            this.e.innerHTML += this.getObjectDetails(message) + "<br><br>";
        }else{
            this.e.innerHTML += message + "<br>";
        }
    }

    static getObjectDetails = (obj)=>{
        let output = '';
        for (let prop in obj) {
            if (typeof obj[prop] === 'function') {
                output += `${prop}: ${obj[prop].toString()}\n`;
            } else {
                output += `${prop}: ${obj[prop]}\n`;
            }
        }
        return output;
    }
}

class APITester {
    constructor(json_list, logger) {
      this.json_list = json_list;
      this.logger = logger;
      this.results = [];
      this.currentIndex = 0;
    }
  
    start(callback) {
      const test = this.json_list[this.currentIndex];
      const xhr = new XMLHttpRequest();
      const formData = new FormData();
      for (const key in test.parameters) {
        formData.append(key, test.parameters[key]);
      }
      xhr.open(test.method, test.url, true);
      xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            //handle errors
            const expected = test.result;
            let result;
            if (xhr.status != 200){
                result = {
                    status:"fail",
                    statusCode:xhr.status,
                    expectedResults:JSON.stringify(expected),
                    response:xhr.responseText,
                    headers:xhr.getAllResponseHeaders()
                }
                this.logger(`Test ${this.currentIndex + 1}: <span class="text-danger">fail</span>`, result);
            }else{
                const response = JSON.parse(xhr.responseText);
                const resultB = JSON.stringify(response) === JSON.stringify(expected);
                result = {
                    status: (resultB ? 'pass' : 'fail'),
                    statusCode:xhr.status,
                    expectedResults:JSON.stringify(expected),
                    response:xhr.responseText,
                    headers:xhr.getAllResponseHeaders()
                }
                this.logger(`Test ${this.currentIndex + 1}: ${resultB ? '<span class="text-success">pass</span>' : '<span class="text-danger">fail</span>'}`, result);
            }
            //save the results
            this.results[this.currentIndex] = result;

            if (this.currentIndex === this.json_list.length - 1) {
                callback(this.results);
            } else {
                this.currentIndex++;
                this.start(callback);
            }
        }
      };
      xhr.send(formData);
    }
}

  

$(document).ready(()=>{
    //initilize the application
    outputConsole = new MyConsole($("#output-console")[0]);
    btnLoad = $("#btn-load");
    btnLoad.on("click", LoadTesterFile);

    btnRun = $("#btn-run");
    btnRun.on("click", StartTest);

    inputTestFile = $("#input-file");

    outputConsole.log("Application Loaded");

    testArray = [
        {
          "url": "http://localhost:8080/api/ap1.json",
          "method": "post",
          "parameters": {"param1": "value", "param2": "value"},
          "result": {"error": false, "data": "xxx"}
        },
        {
            "url": "http://localhost:8080/api/ap2.json",
            "method": "post",
            "parameters": {"param1": "value", "param2": "value"},
            "result": {"error": false, "data": "xxx"}
        },
        // add more tests here
    ];
    $("#current-json-text").html(formatJSON(JSON.stringify(testArray)));
});

const LoadTesterFile = ()=>{
    let jsn = getJSONFile(inputTestFile[0]).then((txt)=>{
        testArray = JSON.parse(txt);
        $("#current-json-text").html(formatJSON(txt));
    });
    
};

const StartTest = ()=>{      
    const logger = (message) => {
        outputConsole.log(message);
        console.log(message);
    }

    const apitest = new APITester(testArray, logger);
      
    apitest.start((results) => {
        console.log('All tests completed!');
        console.log(results);
        outputConsole.log('All tests completed!');
        outputConsole.log('-------------------');
        PrintResultTable(results);
    });
}


const PrintResultTable = (results)=>{
    out = "<table class=\"table\"><tr><th>Test</th><th>Status</th><th>expected</th><th>response</th><th>headers</th><tr>";
    results.map((r, i)=>{
        out += `<tr><td>${i + 1}</td><td>${r.statusCode} : ${r.status}</td><td>${formatJSON(r.expectedResults)}</td><td>${formatJSON(r.response)}</td><td>${printHeaders(r.headers)}</td></tr>`;
    })
    out += "</table><br>";
    $("#resultTable").html(out);

}

const formatJSON = (json) => {
    if (typeof json !== "string") {
      return json;
    }
    let formattedJSON = JSON.stringify(JSON.parse(json), null, 2)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/("[^"]*")(\s*:)/g, '<span class="text-danger">$1</span>$2')
        .replace(/(:\s*)(true|false|"[^"]*"|-?\d*\.?\d+)/g, function (
            match,
            group1,
            group2
        ) {
            if (/^:\s*"/.test(match)) {
            return group1 + '<span class="text-primary">' + group2 + "</span>";
            } else if (/^:\s*(true|false)$/.test(match)) {
            return group1 + '<span class="text-success">' + group2 + "</span>";
            } else if (/^:\s*-?\d*\.?\d+$/.test(match)) {
            return group1 + '<span class="text-warning">' + group2 + "</span>";
            } else {
            return match;
            }
        });
    return "<pre>" + formattedJSON + "</pre>";
  };
  

  function printHeaders(headersString) {
    const headerLines = headersString.split('\r\n');
    let output = '';
    for (let i = 0; i < headerLines.length; i++) {
      const headerLine = headerLines[i];
      if (headerLine) {
        const [headerName, headerValue] = headerLine.split(': ');
        output += `<div><span class="text-primary">${headerName}:</span> <span class="text-secondary">${headerValue}</span></div>`;
      }
    }
    return output;
  }


const getJSONFile = (fileInput)=>{
    const file = fileInput.files[0];
    if (!file) {
        // No file selected
        return Promise.resolve("[]");
    }
  
    // Check if the file is a text file
    /*if (!file.type || !file.type.match(/^json\//)) {
        return Promise.reject(new Error("File is not a text file"));
    }*/
  
    // Load the file as text
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = (event) => {
            try {
            const text = event.target.result;
            const json = JSON.parse(text);
            if (!Array.isArray(json)) {
                reject(new Error("JSON is not an array"));
            } else {
                resolve(text);
            }
            } catch (error) {
            reject(error);
            }
        };
        reader.readAsText(file);
    }).catch((error) => {
        console.error(error);
        return "[]";
    });
}
  
  