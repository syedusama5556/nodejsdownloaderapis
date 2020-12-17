class TiktokApi {
  constructor(vidurl) {
    this.vidurl = vidurl;
  }

  async getdownloadlink() {
    var axios = require("axios");
    var FormData = require("form-data");
    var data = new FormData();

    data.append("url", this.vidurl);

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

        return object1;
      })
      .catch(function (error) {
        console.log(error);
      });
  }

  async start() {
    // useless await here
    return await getdownloadlink();
  }
}

module.exports = TiktokApi;
