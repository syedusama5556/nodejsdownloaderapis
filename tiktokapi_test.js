var axios = require("axios");
var FormData = require("form-data");
var data = new FormData();



var config = {
  method: 'get',
  url: 'https://www.tiktok.com/node/share/video/@freefirepklkofficial/6933821265044114689/?aid=1988&app_name=tiktok_web&device_platform=web&referer=&root_referer=&user_agent=Mozilla/5.0 (Linux; Android 10;TXY567) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/8399.0.9993.96 Mobile Safari/599.36&cookie_enabled=true&screen_width=1080&screen_height=1920&browser_language=en-us&browser_platform=Linux&browser_name=chrome&browser_version=8399&browser_online=true&ac=4g&timezone_name=UTC+03&appId=1233&appType=m&isAndroid=true&isMobile=true&isIOS=false&OS=windows&itemId=6934534268102266114&language=en-us',
headers: { 
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 11_2_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.72 Safari/537.36', 
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9', 
    'Accept-Language': 'en-US,en;q=0.9', 
    'Range': 'bytes=0-200000', 
    'Referer': 'https://www.tiktok.com/', 
    'Cookie': 'tt_webid_v2=6932317619589449222; tt_webid=693231761958944922; tt_csrf_token=FACzk-WkRvNAo57F7bN8m7vq; tt_webid=6935274800207676929; tt_webid_v2=6935274800207676929; ak_bmsc=8FC15C6892D1C5A71C014150142926A7B6B09CB684250000A13F3F608DEB5147~pl2CBNjlYlQycCaHUJO87E2R1LA3jaSl0cm9h1MqQ2bp2Kx2NQWDMN5AG/dvS2PWzVz2pFeTSlIL78KCSRFnOLSPiA1/ak5WrulPYUfs97d6sfr0MpqoleL5l2pF1gpadI1ezXJ6P0K/IC/mQGEod/cbxHkgE1440KeDh1dFPLLSKeuYr6GuqRqTEEPYoZg5K/GdqoIg7hmH+r/KZkwjvrKgcYoSLX0uMWhcyuRk/3R1wgraDXUxVqSxcBuQL6Lg2m; bm_sv=25B6941932977391FDDA5B2371421F1A~M3pGpCE+xd0+1xIg0XQoVbsqMw3cC54+fU4wre3EdohygSg91xWARrIKv3wS6ObcOoDnCFGhkmWaBBFjghegKMig3tK6pMP/Qgb2nKD7CDbsqYhqsh9VayXmGk9h/ACjkaVQF8MxFVviXi7ooiq0go18VHJFGjmpKMtRYJJ3hSI=; bm_sz=BF8F4932CD652BF662FB6C2EDE438B26~YAAQnpywttmYGu53AQAAUVAb9woOqaIwJKFjhkqiOyFpcc8n1iQbaE8wsGVNSOflHqWiSHaRJFvYALmiJIW5amBzeVvQtCIyuV9pnhqC9rJxh7q5liSy/xkBDL5bPQomkiHRp56PQ2qFurk+GBiynoS/NrFWobhHMFJ0EoRJAppYny8e8lqnxQfWmD73Ryf8; _abck=570C412B56A4FBDFBE02DCC6260E703C~-1~YAAQnpywttqYGu53AQAAUVAb9wVVGsn8AnvyRDIXmczSAp/1I2DpQHfSwjZh593dyfjss9zf94O35FybPPSdIPg3pEVt8ESeEJzWc6apuaL7+oLr6eUaX1SF9V33obbH08UoOhOD0l2TrOucsEUYPMyRil23KLytmoT2WsCqKOVYI7WGuyT9s11cxsgYH5LMpPGqgjp44l6MwDj+VbQbye/AS4VIEDGGYRibV5zWHPbxjugo1fYIgx4X6kaN+FbcVTJflGGdx4f6PTx1VeryQVN0+euv+h38Vcr4j68PhnYp6JiMnO0H4uYPGl7l9YJfiyxf/ajMfW3FFA63wsONE9pk2ufpMa89jwyeumtREAT52s06GKERf7bKDhiEH+f5jgpC6TnhpCqITA==~-1~-1~-1'
  }
};

axios(config)
.then(function (response) {
  console.log(JSON.stringify(response.data));
})
.catch(function (error) {
  console.log(error);
});

