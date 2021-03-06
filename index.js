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

  //     function format_size($bytes)
  // {
  //     switch ($bytes)
  //     {
  //         case $bytes < 1024:c;
  //             $size = $bytes . " B";
  //         break;
  //         case $bytes < 1048576:
  //             $size = round($bytes / 1024, 2) . " KB";
  //         break;
  //         case $bytes < 1073741824:
  //             $size = round($bytes / 1048576, 2) . " MB";
  //         break;
  //         case $bytes < 1099511627776:
  //             $size = round($bytes / 1073741824, 2) . " GB";
  //         break;
  //     }
  //     if (!empty($size))
  //     {
  //         return $size;
  //     }
  //     else
  //     {
  //         return "";
  //     }
  // }

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
   
       
   
   
   
   
   
   

  } else if (url.includes("veoh")) {



    url = url.substring(url.lastIndexOf("/") + 1);


  console.log("dgasjhdjhasdjah = "+url)

    var axios = require('axios');

var config = {
  method: 'get',
  url: 'http://www.veoh.com/watch/getVideo/'+url,
  headers: { 
    'User-Agent': 'Mozilla/5.0 (Linux; Android 10;TXY567) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/8399.0.9993.96 Mobile Safari/599.36', 
    'Cookie': 'lang=en; laravel_session=eyJpdiI6InhoOUxsWnhIWmd3U3dzMmlcLzAxRDlRPT0iLCJ2YWx1ZSI6InRkOVpPaXFwc1Bvdkh3bUd2eEo1YmRvbjY2MGFmTXcrSytMV2N5cHZIanhDWE9pazFwWjdDeGhPa0tqYyt2cWt5UFdQbFg1aDRiUFRrTkV5b3AxXC9CUT09IiwibWFjIjoiNTU2MGM5MWMxYmNjNjFkZDQ1OTY3NWE3MmIyMTNmYTViYzVjNDI4NDdmYWUxOWI3ZmRiZTRmM2IxYTNiNWRiMCJ9'
  }
};

axios(config)
.then(function (response) {
 

var jsondata = response.data;

  var status = response.data.status;






  var object1 = {
    title: jsondata["video"]["title"],
    source: "veoh",
    thumbnail: jsondata["video"]["src"]["poster"],
    duration: jsondata["video"]["length"],
    message: status,
    links: [
      {
        url:  jsondata["video"]["src"]["HQ"],
        size: jsondata["video"]["size"],
        quality: "HQ",
        mute: "no",
      },     {
        url: jsondata["video"]["src"]["Regular"],
        size: jsondata["video"]["size"],
        quality: "Regular",
        mute: "no",
      }
    ],
  };
  
  res.status(200).json(object1);




})
.catch(function (error) {
  console.log(error);
});






  } else if (url.includes("mxtakatak")) {
    //  // TakaTak
    var axios = require("axios");
    var FormData = require("form-data");
    var data = new FormData();
    data.append("url", url);

    var config = {
      method: "post",
      url: "https://mxtakatakvideodownloader.com/tiktok-service.php",
      headers: {
        ...data.getHeaders(),
      },
      data: data,
    };

    axios(config)
      .then(function (response) {
        // console.log(JSON.stringify(response));
        var name = response.data.name;
        var profile_pic_url = response.data.profile_pic_url;
        var thumbnailUrl = response.data.thumbnailUrl;
        var status = response.data.status;
        var videourl = response.data.videourl;
        var username = response.data.username;
        var songurl = response.data.songurl;
        var ogvideourl = response.data.ogvideourl;

        var object1 = {
          title: name,
          source: "mxtaktak",
          thumbnail: thumbnailUrl,
          duration: "00:15",
          message: status,
          links: [
            {
              url: videourl,
              songurl: songurl,
              ogvideourl: ogvideourl,
              size: "9.86 MB",
              quality: "720p",
              mute: "no",
            },
          ],
        };
        res.status(200).json(object1);

        //  console.log(object1);
      })
      .catch(function (error) {
        console.log(error);
      });
  } else if (url.includes("youtube") || url.includes("youtu.be")) {
    var request = require("request");
    var options = {
      method: "GET",
      url:
        "https://dlphpapis.herokuapp.com/api/info?url=" +
        url +
        "&flatten=True",
      headers: {},
    };
    request(options, function (error, response) {
      if (error) throw new Error(error);
      var objjsonsound = JSON.parse(response.body);
      console.log(objjsonsound["videos"][0]["alt_title"]);
      // console.log(objjsonsound['videos'][0]['formats'])

      var linkdsdata = [];
      var object1 = {
        title: objjsonsound["videos"][0]["alt_title"],
        source: "youtube",
        thumbnail: objjsonsound["videos"][0]["thumbnail"],
        duration: objjsonsound["videos"][0]["duration"] + "sec",
        message: "true",
        links: linkdsdata,
      };

      for (
        var i = 0;
        i < objjsonsound["videos"][0]["formats"].length - 1;
        i++
      ) {
        var mydaaa = objjsonsound["videos"][0]["formats"][i];

        var audioquality = "";

        if (!mydaaa["acodec"] == "" && mydaaa["acodec"] == "mp4a.40.2" ) {
          audioquality = mydaaa["format_note"] ;
        } else {
          audioquality = mydaaa["format_note"]+ "(no audio)";
        }

        console.log("my code "+mydaaa["acodec"]);
        console.log("my audio "+audioquality);


        var mylinksdat = {
          url: mydaaa["url"],
          size:
            (
              Math.round(
                (mydaaa["filesize"] * 0.000001 + Number.EPSILON) * 100
              ) / 100
            ).toString() + " MB",
          quality: mydaaa["format_note"],
          type: mydaaa["ext"],
          mute: "false",
        };
        linkdsdata.push(mylinksdat);

        //console.log(response.data);
      }
      //console.log(object1);
      res.status(200).json(object1);
    });
  }
  
  

else if (url.includes("soundcloud")) {
    // soundcloud
    // <title>Bewafa Tera Masoom Chehra - Jubin Nautiyal by AITCH</title>
    //https://soundcloud.com/raja-saadain-nazir-873025150/raaz-e-ulfat-ost-shahzad

    var request = require("request");

    request({ uri: url }, function (error, response1, body) {
      var strn = get_string_between_with_extra(body, '[{"id":', "}}}]}]");

      var objjsonsound = JSON.parse(strn);

      var mytranscodeingsarray =
        objjsonsound[6]["data"][0]["media"]["transcodings"];

      for (var i = 0; i < mytranscodeingsarray.length; i++) {
        if (mytranscodeingsarray[i]["format"]["protocol"] == "progressive") {
          // ?client_id=8af436d1e78348ab09f81a99bf43485b

          request(
            {
              uri:
                mytranscodeingsarray[i]["url"] +
                "?client_id=8af436d1e78348ab09f81a99bf43485b",
            },
            function (error, response2, body) {
              var objjsonsound = JSON.parse(body);

              // console.log();

              var newurl =
                "https://soundcloud.com/oembed?url=" + url + "&format=json";

              var request1 = require("request");
              var options = {
                method: "GET",
                url: newurl,
                headers: {},
              };

              request1(options, function (error, response) {
                var obj = JSON.parse(response.body);
                var titleis = obj.title;
                var thumb = obj.thumbnail_url;

                var remote = require("remote-file-size");
                var url = objjsonsound["url"];
                remote(url, function (err, o) {
                  var object1 = {
                    title: titleis,
                    source: "soundcloud",
                    thumbnail: thumb,
                    duration: "00:15",
                    message: "true",
                    links: [
                      {
                        url: objjsonsound["url"],
                        type: "mp3",
                        size: (o * 0.000001).toString() + " MB",
                        quality: "hd",
                        mute: "no",
                      },
                    ],
                  };
                  res.status(200).json(object1);
                  //console.log(object1);                })
                });
              });
              console.log(newurl);
            }
          );
        }
      }

      //https://soundcloud.com/oembed?url=https://soundcloud.com/raja-saadain-nazir-873025150/raaz-e-ulfat-ost-shahzad&format=json
    });
  } else if (url.includes("bandcam")) {
    // bandcam https://mikehuguenor.bandcamp.com/album/xed

    var request = require("request");

    request({ uri: url }, function (error, response, body) {


      var title = get_string_between(body, "<title>", "</title>");

      const jsdom = require("jsdom");
      const { JSDOM } = jsdom;
      const dom = new JSDOM(body);

      var embededurl = dom.window.document.querySelector(
        'meta[property="og:video"]'
      ).content;
      var thumb = dom.window.document.querySelector('a[class="popupImage"]')
        .href;
      console.log(thumb);

      request({ uri: embededurl }, function (error, response, body2) {
        var embed_url = get_string_between_with_extra_colen(
          body2,
          "var playerdata =",
          "var parentpage"
        );
        var part = embed_url.substring(
          embed_url.indexOf("{"),
          embed_url.lastIndexOf(";")
        );
        var objjsonsound = JSON.parse(part);

        // console.log(objjsonsound)

        var linkdsdata = [];
        var object134 = {
          title: title,
          source: "bandcam",
          thumbnail: thumb,
          duration: objjsonsound["tracks"][0]["file"]["duration"] + "sec",
          message: "true",
          links: linkdsdata,
        };

        for (var i = 0; i < objjsonsound["tracks"].length - 1; i++) {
          // console.log(objjsonsound['tracks'][i]["file"]["mp3-128"]);

          var mylinksdat = {
            url: objjsonsound["tracks"][i]["file"]["mp3-128"],
            size: "2.67 MB",
            quality: objjsonsound["tracks"][i]["title"] + " (hd)",
            mute: "false",
            type: "mp3",
          };

          linkdsdata.push(mylinksdat);
        }

        res.status(200).json(object134);
      });
    });
  } else if (url.includes("bitchute")) {
    //bitchute  https://www.bitchute.com/video/8xYXZiCaRHQg/

    var request = require("request");

    request({ uri: url }, function (error, response, body) {
      var title = get_string_between(body, "<title>", "</title>");

      // console.log(duration);

      const jsdom = require("jsdom");
      const { JSDOM } = jsdom;
      const dom = new JSDOM(body);

      var thumbnailp = dom.window.document.querySelector('video[id="player"]')
        .poster;
      console.log(thumbnailp);

      var videourl = dom.window.document.querySelector("source").src;
      console.log(videourl);

      var duration = dom.window.document.querySelector(
        'span[class="video-duration"]'
      ).textContent;
      console.log(duration);

      var remote = require("remote-file-size");
      remote(videourl, function (err, o) {
        var s = Math.round(o * 0.000001);

        var object1 = {
          title: title,
          source: "bitchute",
          thumbnail: thumbnailp,
          duration: duration,
          message: "true",
          links: [
            {
              url: videourl,
              size: s.toString() + " MB",
              quality: "720p",
              type: "mp4",
              mute: "no",
            },
          ],
        };

        res.status(200).json(object1);
      });
    });
  } else if (url.includes("fthis")) {
    //fthis
    //https://www.fthis.gr/videos/despoina-bandh-neo-ntoyeto-me-thn-korh-ths-melina-nikolaidh-video //TODO

    var request = require("request");

    request({ uri: url }, function (error, response, body) {
      var title = get_string_between(response.body, "<title>", "</title>");
      var titlesourcesrc = get_string_between(
        response.body,
        '<source src="',
        'type="video/mp4">'
      );

      console.log(title);
      //  console.log(titlesourcesrc);

      // var videourl = dom.window.document.querySelector("source").src;
      // console.log(videourl);

      // var duration = dom.window.document.querySelector(
      //   'span[class="video-duration"]'
      // ).textContent;
      // console.log(duration);

      // var remote = require("remote-file-size");
      // remote(videourl, function (err, o) {
      //   var s = Math.round(o * 0.000001);

      //   var object1 = {
      //     title: title,
      //     source: "fthis",
      //     thumbnail: "https://pbs.twimg.com/profile_images/758986182436859908/qwxD4Qog.jpg",
      //     duration: "NaN sec",
      //     message: "true",
      //     links: [
      //       {
      //         url: videourl,
      //         size: s.toString() + " MB",
      //         quality: "HD",
      //         type: "mp4",
      //         mute: "no",
      //       },
      //     ],
      //   };

      //   res.status(200).json(object1);
      // });
    });
  } else if (url.includes("izlesene")) {
    //bitchute  https://www.izlesene.com/video/ehliyetsiz-surucuden-pes-dedirten-savunma-sadece-gece-biniyorum/10519222

    // window._videoObj = {

    // }};

    var request = require("request");

    request({ uri: url }, function (error, response, body) {
      var title =
        "{" + get_string_between(body, "window._videoObj = {", "}};") + "}}";

      var objjsonsound = JSON.parse(title);
      console.log(objjsonsound["media"]["level"].length);
      console.log(objjsonsound["media"]["level"][0]["source"]);

      var linkdsdata = [];

      var object1 = {
        title: objjsonsound["videoTitle"],
        source: "izlesene",
        thumbnail: objjsonsound["posterURL"],
        duration: objjsonsound["duration"] / 1000 + "sec",
        message: "true",
        links: linkdsdata,
      };

      if (objjsonsound["media"]["level"].length == 1) {
        var mylinksdat = {
          url: objjsonsound["media"]["level"][0]["source"],
          size: "NaN MB",
          quality: objjsonsound["media"]["level"][0]["value"],
          mute: "false",
          type: "mp4",
        };

        linkdsdata.push(mylinksdat);
      } else {
        for (var i = 0; i < objjsonsound["media"]["level"].length - 1; i++) {
          // console.log(objjsonsound['tracks'][i]["file"]["mp3-128"]);

          var mylinksdat = {
            url: objjsonsound["media"]["level"][i]["source"],
            size: "NaN MB",
            quality: objjsonsound["media"]["level"][i]["value"],
            mute: "false",
            type: "mp4",
          };

          linkdsdata.push(mylinksdat);
        }
      }

      res.status(200).json(object1);
    });
  } else if (url.includes("linkedin")) {
    //linkdin  https://www.linkedin.com/posts/ajjames_wow-this-guy-has-skills-what-could-go-wrong-ugcPost-6746360912342462464-5Nf6

    // window._videoObj = {

    // }};

    var request = require("request");

    request({ uri: url }, function (error, response, body) {
      var mydatais =
        "[{" + get_string_between(body, 'data-sources="[{', '}]"') + "}]";
      //  var poster = get_string_between(body, "data-poster-url=", "data");

      const Entities = require("html-entities").AllHtmlEntities;

      const entities = new Entities();

      var objjsonsound = JSON.parse(entities.decode(mydatais));

      var title = get_string_between(body, "<title>", "</title>");

      console.log(response.headers);

      var linkdsdata = [];

      var object1 = {
        title: title,
        source: "linkdin",
        thumbnail:
          "https://www.researchsnipers.com/wp-content/uploads/2018/06/linkedinlogo.png",
        duration: "NaN sec",
        message: "true",
        links: linkdsdata,
      };

      for (var i = 0; i < objjsonsound.length - 1; i++) {
        // console.log(objjsonsound['tracks'][i]["file"]["mp3-128"]);

        var mylinksdat = {
          url: objjsonsound[i]["src"],
          size: "NaN MB",
          quality: "HD",
          mute: "false",
          type: "mp4",
        };

        linkdsdata.push(mylinksdat);
      }

      res.status(200).json(object1);
    });
  } else if (
    url.includes("kwai") ||
    url.includes("imdb") ||
    url.includes("imgur") ||
    url.includes("likee") ||
    url.includes("liveleak") ||
    url.includes("espn") ||
    url.includes("gag") ||
    url.includes("flickr") ||
    url.includes("kw.ai") ||
    url.includes("abc") ||
    url.includes("ok.ru") ||
    url.includes("pinterest") ||
    url.includes("gfycat") ||
    url.includes("reddit") || //todo not working withaudio
    url.includes("redd.it") ||
    url.includes("streamable") ||
    url.includes("ted") ||
    url.includes("twitter") ||
    url.includes("tumblr") ||
    url.includes("videoclip.bg") ||
    url.includes("vk") ||
    url.includes("vigovideo") ||
  url.includes("dailymotion") ||
    url.includes("wwe") ||
    url.includes("facebook") ||
    url.includes("vimeo")
  ) {
    //linkdin  http://kw.ai/p/1mIGdN98
    //https://ok.ru/video/2872405723834

    var encoded1 = "";
    try {
      encoded1 = encodeURI(url);
    } catch (error) {
      encoded1 = url;
    }
    //   var encoded1 = encodeURI(url);
    // console.log(encoded1);

    getDataFromRemoteApi(encoded1, res);
  } else if (url.includes("mashable")) {
    //linkdin  https://www.linkedin.com/posts/ajjames_wow-this-guy-has-skills-what-could-go-wrong-ugcPost-6746360912342462464-5Nf6

    // window._videoObj = {

    // }};

    var request = require("request");

    request({ uri: url }, function (error, response, body) {
      var mydatais =
        '{"@context":' +
        get_string_between(
          body,
          '<script type="application/ld+json">{"@context":',
          "}</script>"
        ) +
        "}";
      //  var poster = get_string_between(body, "data-poster-url=", "data");

      const jsdom = require("jsdom");
      const { JSDOM } = jsdom;
      const dom = new JSDOM(body);

      var thumbnailp = dom.window.document.querySelectorAll(
        'script[type="application/ld+json"]'
      )[1].textContent;
      var objjsonsound = JSON.parse(thumbnailp);
      console.log(objjsonsound["description"]);

      var title = objjsonsound["name"];

      var object1 = {
        title: title,
        source: "mashable",
        thumbnail: objjsonsound["thumbnailUrl"],
        duration: objjsonsound["duration"],
        message: "true",
        links: {
          url: objjsonsound["contentUrl"],
          size: "NaN MB",
          quality: "HD",
          mute: "false",
          type: "mp4",
        },
      };

      res.status(200).json(object1);
    });
  } else if (url.includes("douyin")) {
    //douyin  https://www.iesdouyin.com/share/video/6878314461388639501

    var axios = require("axios");

    var vidid = url.substring(url.lastIndexOf("/") + 1);
    // console.log(vidid);

    var newurlis =
      "https://www.iesdouyin.com/web/api/v2/aweme/iteminfo/?item_ids=" + vidid;

    var config = {
      method: "get",
      url: newurlis,
      headers: {},
    };

    axios(config)
      .then(function (response) {
        var myjsondata = response.data;

        var vidoo =
          response.data["item_list"][0]["video"]["play_addr"]["url_list"][0];
        console.log(vidoo);

        var object1 = {
          title: myjsondata["item_list"][0]["desc"],
          source: "douyin",
          thumbnail:
            myjsondata["item_list"][0]["video"]["cover"]["url_list"][0],
          duration:
            myjsondata["item_list"][0]["video"]["duration"] / 1000 + "sec",
          message: "true",
          links: [
            {
              url:
                myjsondata["item_list"][0]["video"]["play_addr"]["url_list"][0],
              size: "9.4 MB",
              quality: "720p",
              type: "mp4",

              mute: "no",
            },
            {
              url: myjsondata["item_list"][0]["music"]["play_url"]["uri"],
              size: "1.4 MB",
              quality: "128kbps",
              type: "mp3",

              mute: "no",
            },
          ],
        };

        res.status(200).json(object1);
      })
      .catch(function (error) {
        console.log(error);
      });
  } else {
    console.log("Error");
    res.status(404).json({ message: "URL NOT FOUND", status: "404" });
  }
});

app.listen(port, () => {
  console.log("App is listening on port " + port);
});

function formet_size(bytes) {
  switch (bytes) {
    case bytes < 1024:
      var size = bytes;

      return size.toString() + "B";

    case bytes < 1048576:
      return Math.round(bytes / 1024) + "KB";

    case bytes < 1073741824:
      return Math.round(bytes / 1048576).toString() + "MB";

    case bytes < 1099511627776:
      return Math.round(bytes / 1073741824) + "GB";
  }
}

function get_string_between(webpage, strstart, strend) {
  var part = webpage.substring(
    webpage.indexOf(strstart) + strstart.length,
    webpage.indexOf(strend)
  );

  return part;
}

function get_string_between_with_extra(webpage, strstart, strend) {
  var part = webpage.substring(
    webpage.indexOf(strstart),
    webpage.indexOf(strend) + strend.length
  );

  return part;
}

function get_string_between_with_extra_colen(webpage, strstart, strend) {
  var part = webpage.substring(
    webpage.indexOf(strstart),
    webpage.indexOf(strend) + strend.length
  );

  return part;
}

function getDataFromRemoteApi(urlis, res) {
  var axios = require("axios");

  var config = {
    method: "get",
    url:
      "http://keepsaveit.com/api?api_key=OlfZ0U6RbbV8wA7U4rquAAOQTCp5z7JPl7NNDmx39qgfaxIEqh&url=" +
      urlis,
  };

  axios(config)
    .then(function (response) {
      var objjsonsound = response.data;

      var linkdsdata = [];

      var title1 = "";
      const isset = require("isset");

      if (!isset(objjsonsound["response"])) {
        console.log("Error");
        res.status(404).json({ message: "URL NOT FOUND", status: "404" });
      }

      var object1 = {
        title: title1,
        source: objjsonsound["domain"],
        thumbnail: objjsonsound["response"]["thumbnail"],
        duration: objjsonsound["duration"],
        message: "true",
        links: linkdsdata,
      };

      //  console.log(objjsonsound["response"]["links"]);

      if (objjsonsound["response"]["links"].length == 1) {
        var mylinksdat = {
          url: objjsonsound["response"]["links"][0]["url"],
          size: objjsonsound["response"]["links"][0]["size"],
          quality: objjsonsound["response"]["links"][0]["resolution"],
          mute: "false",
          type: "mp4",
        };

        linkdsdata.push(mylinksdat);
      } else {
        for (var i = 0; i < objjsonsound["response"]["links"].length - 1; i++) {
          //  console.log(objjsonsound["response"]["links"][i]["url"]);

          var mylinksdat = {
            url: objjsonsound["response"]["links"][i]["url"],
            size: objjsonsound["response"]["links"][i]["size"],
            quality: objjsonsound["response"]["links"][i]["resolution"],
            mute: "false",
            type: "mp4",
          };

          linkdsdata.push(mylinksdat);
          // if(i == )
        }
      }

      res.status(200).json(object1);
    })
    .catch(function (error) {
      console.log(error);
    });
}
