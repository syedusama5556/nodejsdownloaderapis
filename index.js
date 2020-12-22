const { json } = require("express");
const express = require("express");

const app = express();
app.use(express.json());
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
    data.append("url", req.body.url);

    var config = {
      method: "post",
      url: "https://savetik.app/go.php",
      headers: {
        ...data.getHeaders(),
      },
      data: data,
    };

    axios(config)
      .then(function (response) {
        //    var tiktokjsondata=  JSON.stringify(response)
        //     console.log(response.data.vUrl)

        var object1 = {
          title: "",
          source: "tiktok",
          thumbnail:
            "https://p16-sign-sg.tiktokcdn.com/obj/tos-alisg-p-0037/f2af58ca6a3e4200a0b626e0c7dd09b5?x-expires=1607860800&x-signature=bS1a40wbmglEwPUUvAsl%2BZO382A%3D",
          duration: "00:15",
          message: "Success",
          links: [
            {
              url: response.data.vUrl,
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
  } else if (url.includes("dailymotion")) {
    // DAILY MOTION

    var axios = require("axios");
    var FormData = require("form-data");
    var data = new FormData();
    data.append("url", "https://www.dailymotion.com/video/x7y1dxz");

    var config = {
      method: "post",
      url: "https://dailymotion.aiovideodl.ml/system/action.php",
      headers: {
        "User-Agent": "Mozilla/4.73 [en] (X11; U; Linux 2.2.15 i686)",
        Cookie:
          "__cfduid=ddaadddf6ba7620bf1739308a21c77c641607757504; PHPSESSID=d865639e53531316013b386b4361ad77",
        ...data.getHeaders(),
      },
      data: data,
    };

    axios(config)
      .then(function (response) {
        // console.log(JSON.stringify(response.data));

        var linkdsdata = [];
        var object1 = {
          title: response.data["title"],
          source: "dailymotion",
          thumbnail: response.data["thumbnail"],
          duration: "00:15",
          message: "true",
          links: linkdsdata,
        };

        for (var i = 0; i < response.data.links.length; i++) {
          var cc = {
            url: response.data.links[i]["url"],
            type: "mp4",
            title: response.data["title"],
            source: "dailymotion",
          };

          var httpBuildQuery = require("http-build-query");

          var vvv =
            "https://dailymotion.aiovideodl.ml/dl.php?" + httpBuildQuery(cc);

          var mylinksdat = {
            url: vvv,
            size: response.data.links[i]["size"],
            quality: response.data.links[i]["quality"],
            mute: response.data.links[i]["mute"],
            type: "mp4",
          };
          linkdsdata.push(mylinksdat);

          //console.log(response.data);
        }
        //console.log(object1);
        res.status(200).json(object1);
      })
      .catch(function (error) {
        console.log(error);
      });
  } else if (url.includes("soundcloud")) {
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

      console.lo;

      var linkdsdata = [];

      var title1 = "";
      const isset = require("isset");

      if (isset(objjsonsound["response"])) {
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

      //   console.log(objjsonsound["response"]["links"].length);

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
