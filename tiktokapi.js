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
    data.append("url", req.body.url);


    data.append('id', req.body.url);
    data.append('locale', 'en');
    data.append('tt', '779a7d96ef51ac3943028e274d454e0c');
    data.append('ts', '26744248');
    data.append('User-Agent', 'ssstiktok.io/1.0@|addr:39.43.103.117/com.sss.video.downloader');
    data.append('Authorization', 'd9a97b094b5a1cdbfaab98d117031de5f01e4faec165c5a6bdc452d1a52fc268');
    
    var config = {
      method: 'post',
      url: 'https://api2.ssstiktok.io/1/fetch',
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
              url: embededurl1,
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

});


    // var config = {
    //   method: "post",
    //   url: "https://savetik.app/go.php",
    //   headers: {
    //     ...data.getHeaders(),
    //   },
    //   data: data,
    // };

    // axios(config)
    //   .then(function (response) {
    //     //    var tiktokjsondata=  JSON.stringify(response)
    //     //     console.log(response.data.vUrl)

    //     var object1 = {
    //       title: "",
    //       source: "tiktok",
    //       thumbnail:
    //         "https://p16-sign-sg.tiktokcdn.com/obj/tos-alisg-p-0037/f2af58ca6a3e4200a0b626e0c7dd09b5?x-expires=1607860800&x-signature=bS1a40wbmglEwPUUvAsl%2BZO382A%3D",
    //       duration: "00:15",
    //       message: "Success",
    //       links: [
    //         {
    //           url: response.data.vUrl,
    //           type: "mp4",
    //           size: "2.3 MB",
    //           quality: "720p",
    //           mute: "no",
    //         },
    //       ],
    //     };

    //     res.status(200).json(object1);
    //   })
    //   .catch(function (error) {
    //     console.log(error);
    //   });


    app.listen(port, () => {
      console.log("App is listening on port " + port);
    });
