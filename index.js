const { json } = require('express');
const express = require('express');


const app = express();
app.use(express.json());
const request = require('request');
const port = process.env.PORT || 3000;

app.post('/api' , function(req , res) {
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
    var axios = require('axios');
    var FormData = require('form-data');
    var data = new FormData();


    if(url.includes("tiktok")){

      data.append('url', req.body.url);
      
      

      var config = {
        method: 'post',
        url: 'https://savetik.app/go.php',
        headers: { 
          ...data.getHeaders()
        },
        data : data
      };
      
      axios(config)
      .then(function (response) {
      
    //    var tiktokjsondata=  JSON.stringify(response)
   //     console.log(response.data.vUrl)

       var object1 = {
        title: "",
        source: "tiktok",
        thumbnail: "https://p16-sign-sg.tiktokcdn.com/obj/tos-alisg-p-0037/f2af58ca6a3e4200a0b626e0c7dd09b5?x-expires=1607860800&x-signature=bS1a40wbmglEwPUUvAsl%2BZO382A%3D",
        duration: "00:15",
        message:"Success",
        links: [
            {
                url: response.data.vUrl,
                type: "mp4",
                size: "2.3 MB",
                quality: "720p",
                mute: "no"
            }
        ]
    };
    


       res.status(200).json(object1);
    






       
      })
      .catch(function (error) {
        console.log(error);
      });

    }


    else if(url.includes('mxtakatak')){




//  // TakaTak
var axios = require('axios');
var FormData = require('form-data');
var data = new FormData();
data.append('url', url);

var config = {
  method: 'post',
  url: 'https://mxtakatakvideodownloader.com/tiktok-service.php',
  headers: { 
    ...data.getHeaders()
  },
  data : data
};

axios(config)
.then(function (response) {
  console.log(JSON.stringify(response));
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
        source: "tiktok",
        thumbnail: thumbnailUrl,
        duration: "00:15",
        message:status,
        links: [
            {
                url:videourl,
                songurl: songurl,
                ogvideourl: ogvideourl,
                size: "9.86 MB",
                quality: "720p",
                mute: "no"
            }
        ]
    };
    res.status(200).json(object1);

  //  console.log(object1);


})
.catch(function (error) {
  console.log(error);
});


    }
    else if(url.includes('dailymotion')){
 // DAILY MOTION



 var axios = require('axios');
 var FormData = require('form-data');
 var data = new FormData();
 data.append('url', 'https://www.dailymotion.com/video/x7y1dxz');
 
 var config = {
   method: 'post',
   url: 'https://dailymotion.aiovideodl.ml/system/action.php',
   headers: { 
     'User-Agent': 'Mozilla/4.73 [en] (X11; U; Linux 2.2.15 i686)', 
     'Cookie': '__cfduid=ddaadddf6ba7620bf1739308a21c77c641607757504; PHPSESSID=d865639e53531316013b386b4361ad77', 
     ...data.getHeaders()
   },
   data : data
 };
 
 axios(config)
 .then(function (response) {
  // console.log(JSON.stringify(response.data));




  var linkdsdata = []
  var object1 = {
    title: response.data['title'],
    source: "dailymotion",
    thumbnail: response.data['thumbnail'],
    duration: "00:15",
    message:"true",
    links: linkdsdata
};

for(var i=0;i<response.data.links.length;i++){

  var cc = {"url": response.data.links[i]['url'],
   "type": "mp4",
   "title": response.data['title'],
   "source": "dailymotion"}
   
   var httpBuildQuery = require('http-build-query');


   var vvv = "https://dailymotion.aiovideodl.ml/dl.php?"+httpBuildQuery(cc)

 var     mylinksdat = {
        url:vvv,
        size:  response.data.links[i]['size'],        
        quality:  response.data.links[i]['quality'],        
        mute:  response.data.links[i]['mute'],       
          type: "mp4"

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


    }
    
    else if(url.includes('soundcloud')){
      // soundcloud
      // <title>Bewafa Tera Masoom Chehra - Jubin Nautiyal by AITCH</title>
      //https://soundcloud.com/raja-saadain-nazir-873025150/raaz-e-ulfat-ost-shahzad
    
      var request = require("request");

      request({uri: url}, 
          function(error, response1, body) {




var strn = get_string_between_with_extra(body,'[{\"id\":','}}}]}]')

  var objjsonsound = JSON.parse(strn);


var mytranscodeingsarray = objjsonsound[6]['data'][0]['media']['transcodings']


for(var i =0;i<mytranscodeingsarray.length;i++){


  if (mytranscodeingsarray[i]["format"]["protocol"] == "progressive")
  {

    // ?client_id=8af436d1e78348ab09f81a99bf43485b


    request({uri: mytranscodeingsarray[i]['url']+"?client_id=8af436d1e78348ab09f81a99bf43485b"}, 
      function(error, response2, body) {
        var objjsonsound = JSON.parse(body);
        
       // console.log();





        var newurl = "https://soundcloud.com/oembed?url="+url+"&format=json"

        var request1 = require('request');
        var options = {
          'method': 'GET',
          'url': newurl,
          'headers': {
          }
        };
        
        
        request1(options, function (error, response) {
        
          var obj = JSON.parse(response.body);
          var titleis =  obj.title
          var thumb =  obj.thumbnail_url
        
          var object1 = {
            title: titleis,
            source: "soundcloud",
            thumbnail: thumb,
            duration: "00:15",
            message:"true",
            links: [
                {
                    url:objjsonsound['url'],
                    type: "mp3",
                    size: "3.86 MB",
                    quality: "hd",
                    mute: "no"
                }
            ]
        };
        res.status(200).json(object1);
        //console.log(object1);
        
        
        
        });
        console.log(newurl);
          







      });


  }

}




         




     
      

      
     //https://soundcloud.com/oembed?url=https://soundcloud.com/raja-saadain-nazir-873025150/raaz-e-ulfat-ost-shahzad&format=json
      
      
      
        });
     



     
  }    else if(url.includes('bandcam')){
    // soundcloud
   
  
    var request = require("request");

    request({uri: url}, 
        function(error, response, body) {
        console.log(body);
    
    
    
    
    
    
    
    
      });
   



   
}
    else{
      console.log('Error');
      res.status(404).json({message: 'URL NOT FOUND' , status: '404'});
      
    };



});


app.listen(port , ()=>{
    console.log('App is listening on port ' + port);
})






function formet_size(bytes){
  switch(bytes)
  {
    case bytes < 1024 :
      var size = bytes + 'B';
      break;
    
    case bytes < 1048576 : 
     var size = round(bytes / 1024, 2) + 'KB';
      break;
    case bytes < 1073741824 :
      var size = round(bytes / 1048576, 2) + 'MB';
      break;
    case bytes < 1099511627776 :
      var size = round(bytes / 1073741824, 2) + 'GB';
      break;
   }


if (!empty(size))
{
  return size;
}
else
{
  return "";
}

}





function get_string_between(webpage,strstart,strend){


  var part = webpage.substring(webpage.indexOf(strstart)+strstart.length,webpage.indexOf(strend));

return part

}

function get_string_between_with_extra(webpage,strstart,strend){


  var part = webpage.substring(webpage.indexOf(strstart),webpage.indexOf(strend)+strend.length);

return part

}
