const { json } = require("express");
const express = require("express");

const app = express();
app.use(express.json());

app.use(function (req, res, next) {
  // Website you wish to allow to connect
  res.setHeader("Access-Control-Allow-Origin", "*");

  // Request methods you wish to allow
  res.setHeader(
    "Access-Control-Allow-Methods",
    "GET, POST, OPTIONS, PUT, PATCH, DELETE"
  );

  // Request headers you wish to allow
  res.setHeader(
    "Access-Control-Allow-Headers",
    "X-Requested-With,content-type"
  );

  // Set to true if you need the website to include cookies in the requests sent
  // to the API (e.g. in case you use sessions)
  res.setHeader("Access-Control-Allow-Credentials", true);

  // Pass to next layer of middleware
  next();
});

const request = require("request");
const port = process.env.PORT || 3000;

app.post("/api", function (req, res) {
  // console.log(req);
  var url = req.body.url;

  // TIKTOK
  var axios = require("axios");
  var FormData = require("form-data");
  var data = new FormData();

  if (url.includes("tiktok")) {



   // https://www.tiktok.com/api/img/?itemId=6877117764197256449&location=0

  var valis  = Math.floor(Math.random() * (1 - 0 + 1) + 0)
console.log(valis)

valis =0

  if(valis == 0){
 
    data.append("url", req.body.url);


    data.append('id', req.body.url);
    data.append('locale', 'en');
    data.append('tt', '779a7d96ef51ac3943028e274d454e0c');
    data.append('ts', '26744248');
    data.append('User-Agent', 'ssstiktok.io/1.0@|addr:39.43.103.117/com.sss.video.downloader');
    data.append('Authorization', 'd9a97b094b5a1cdbfaab98d117031de5f01e4faec165c5a6bdc452d1a52fc268');
    
    var config = {
      method: 'post',
      url: 'http://api2.ssstiktok.io/1/fetch',
      headers: { 
        'Cookie': 'PHPSESSID=13493505f48fa5a21340c31abd20064f', 
        ...data.getHeaders()
      },
      data : data
    };
    
    axios(config)
    .then(function (response) {

var top = "<!DOCTYPE html><html><body>"

var bottom = "</body></html>"

    //  console.log(top+response.data+bottom);
var htmlbody = top+response.data+bottom


      const jsdom = require("jsdom");
      const { JSDOM } = jsdom;
      const dom = new JSDOM(htmlbody);

      var embededurl1 = dom.window.document.querySelectorAll('a')[0].href;
      var embededurl = dom.window.document.querySelectorAll('a')[1].href;

     // console.log("https://api2.ssstiktok.io/1/video"+embededurl);

        var object1 = {
          title: "",
          source: "tiktok",
          thumbnail:
            "https://p16-sign-sg.tiktokcdn.com/obj/tos-alisg-p-0037/f2af58ca6a3e4200a0b626e0c7dd09b5?x-expires=1607860800&x-signature=bS1a40wbmglEwPUUvAsl%2BZO382A%3D",
          duration: "00:15",
          message: "Success",
          links: [
            {
              url: embededurl,
              type: "mp4",
              size: "2.3 MB",
              quality: "720p",
              mute: "no",
            },
          ],
        };

         res.status(200).json(object1);


    })
    .catch(function (error) {
      console.log(error);
    });
  } else if(valis == 1){


    data.append("ic-request", "true");
    data.append("id", url);
    data.append("ic-element-id", "main_page_form");
    data.append("ic-id", "1");
    data.append("ic-target-id", "active_container");
    data.append("ic-trigger-id", "main_page_form");
    data.append(
      "token",
      "493eaebbf47aa90e1cdfa0f8faf7d04cle0f45a38aa759c6a13fea91d5036dc3b"
    );
    data.append("ic-current-url", "");
    data.append("ic-select-from-response", "#id4fbbea");
    data.append("_method", "nPOST");

    var config = {
      method: "post",
      url: "https://tiktokdownload.online/results",
      headers: {
        "cache-contro": "no-cache",
        "content-type":
          "multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
        origin: "https://tiktokdownload.online",
        "postman-token": "c866af6b-b900-cf0f-2043-1296b0e5362a",
        "sec-fetch-dest": "empty",
        "sec-fetch-mode": "cors",
        "sec-fetch-site": "same-origin",
        "user-agent":
          "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1",
        "x-http-method-override": "POST",
        "x-ic-request": "true",
        "x-requested-with": "XMLHttpRequest",
        Cookie:
          "__cfduid=d5e529ff6ef066d91da301852c656520c1613109111; PHPSESSID=4ff1f9d47a6804c780659fd9657e4b5c",
        ...data.getHeaders(),
      },
      data: data,
    };

    axios(config)
      .then(function (response) {

        const jsdom = require("jsdom");
        const { JSDOM } = jsdom;
        const dom = new JSDOM(response.data);
  
        var embededurl1 = dom.window.document.querySelectorAll('a')[0].href;
       // var embededurl = dom.window.document.querySelectorAll('a')[1].href;

        var embededurl = dom.window.document.querySelector('a[class="btn btn-primary download_link with_watermark"]')
        .href;
        var thumburl =  dom.window.document.querySelectorAll('img')[0].src;
        

        console.log(embededurl);





        var object1 = {
          title: "",
          source: "tiktok",
          thumbnail:thumburl,
          duration: "00:15",
          message: "Success",
          links: [
            {
              url: embededurl,
              type: "mp4",
              size: "2.3 MB",
              quality: "720p",
              mute: "no",
            },
          ],
        };

         res.status(200).json(object1);






      })
      .catch(function (error) {
        console.log(error);
      });


  }

    











  }
});

app.listen(port, () => {
  console.log("App is listening on port " + port);
});
