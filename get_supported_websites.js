var axios = require('axios');

var config = {
  method: 'get',
  url: 'https://dlphpapis.herokuapp.com/api/extractors',
  headers: { }
};

axios(config)
.then(function (response) {


for (let i = 0; i < response.data.extractors.length; i++) {
var da = response.data.extractors[i]    

if (da['working']){
    console.log(da['name']);

//     var fs = require('fs');
// var stream = fs.createWriteStream("my_web.txt");
// stream.once('open', function(fd) {
//   stream.write(da['name']);
//   stream.end();
// });

var fs = require('fs');

fs.appendFileSync("my_sup_websites.txt", da['name']+"\n");


}

}

})
.catch(function (error) {
  console.log(error);
});
