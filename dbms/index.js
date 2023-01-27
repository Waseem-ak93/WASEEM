var con = require('./conn');
var express = require('express');
var app = express();
var bodyparser = require('body-parser');
app.use(bodyparser.json());
app.use(bodyparser.urlencoded({extended:true}));

app.get('/',function(req, res){
    res.sendFile(__dirname+'/reg.html');
});
app.post('/', function(req,res){
    var fname = req.body.firstname;
    var lname = req.body.lastname;
    var gender = req.body.gender;
    var email = req.body.email;
    var pass = req.body.password;
    var mno = req.body.number;
    var country = req.body.country;
    var files = req.body.files;
    con.connect(function(error){
if(error) throw error;
var sql = "INSERT INTO user(firstname,lastname,gender,email,password,number,country,files) VALUES('"+fname+"','"+lname+"','"+gender+"','"+email+"','"+pass+"','"+mno+"','"+country+"','"+files+"')";
con.query(sql, function(error, result){
    if(error) throw error;
    res.send('student registered successfully'+result.insertId);
})
    });
});
app.listen(8080);