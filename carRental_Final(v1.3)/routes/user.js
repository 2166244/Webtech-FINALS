
//---------------------------------------------signup page call------------------------------------------------------
exports.signup = function(req, res){
   message = '';
   if(req.method == "POST"){
      var post  = req.body;
      var name= post.user_name;
      var pass= post.password;
      var fname= post.first_name;
      var lname= post.last_name;
      var mob= post.mob_no;

      var sql = "INSERT INTO `users`(`first_name`,`last_name`,`mob_no`,`user_name`, `password`) VALUES ('" + fname + "','" + lname + "','" + mob + "','" + name + "','" + pass + "')";

      var query = db.query(sql, function(err, result) {

         message = "Succesfully! Your account has been created.";
         res.render('signup.ejs',{message: message});
      });

   } else {
      res.render('signup');
   }
};
 
//-----------------------------------------------login page call------------------------------------------------------
exports.login = function(req, res){
   var message = '';
   var sess = req.session; 

   if(req.method == "POST"){
      var post  = req.body;
      var name= post.username;
      var pass= post.password;

       var sql="SELECT user_id, first_name, last_name, username FROM `users` WHERE (`username`='"+name+"' and password = '"+pass+"')  and (status = 'active' and role='customer')";
       db.query(sql, function(err, results){
           if(results.length && results[0]){
               req.session.userId = results[0].user_id;
               req.session.user = results[0];
               console.log(results[0].user_id);
               res.redirect('home/dashboard');
           }
            else if(results.length && results[0]){
               message = 'Wrong Credentials';
               res.render('index.ejs',{message: message});
            }
      });
       var sql="SELECT * FROM `users` WHERE status = 'active' and role='customer'";
       db.query(sql, function(err, results){
           if(results.length && results[0]){
               message = 'Wrong Credentials';
               res.render('index.ejs',{message: message});
           }
       });

   } else {
      res.render('index.ejs',{message: message});
   }
           
};
//-----------------------------------------------dashboard page functionality----------------------------------------------
           
exports.dashboard = function(req, res, next){
           
   var user =  req.session.user,
   userId = req.session.userId;
   console.log('customer_id:='+userId);
   if(userId == null){
      res.redirect("/login");
      return;
   }

   //var sql="SELECT * FROM `users` WHERE `user_id`='"+userId+"'";
    var sql = "SELECT * FROM `vehicles`";
   db.query(sql, function(err, results){
      res.render('dashboard.ejs', {user:user});    
   });       
};
//------------------------------------logout functionality----------------------------------------------
exports.logout=function(req,res){
   req.session.destroy(function(err) {
      res.redirect("/login");
   })
};
//--------------------------------render user details after login--------------------------------
exports.profile = function(req, res){

   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql="SELECT * FROM `users` WHERE `user_id`='"+userId+"'";
   db.query(sql, function(err, result){  
      res.render('profile.ejs',{data:result});
   });
};
//---------------------------------edit users details after login----------------------------------
exports.editprofile=function(req,res){
   var userId = req.session.userId;
   if(userId == null){
      res.redirect("/login");
      return;
   }

   var sql="SELECT * FROM `users` WHERE `user_id`='"+userId+"'";
   db.query(sql, function(err, results){
      res.render('edit_profile.ejs',{data:results});
   });
};
//==========================| SHOW SERVICES |=============================
exports.services_car = function(req,res){
    var userId = req.session.userId;
    if(userId == null){
        res.redirect("/login");
        return;
    }

    var sql="SELECT * from `vehicles` WHERE status = 'available'";
    db.query(sql, function(err, results){
        res.render('services.ejs',{data:results});
    });
};
//==========================| SEARCH |=============================
exports.search = function(req,res){
    if(req.method == "POST") {
        var item = req.body.search;
        var sql = "SELECT * from `vehicles` where (model LIKE '%" + item + "%' or seating_capacity LIKE '%" + item + "%' or daily_rate LIKE '%" + item + "%') and status = 'available'";
        db.query(sql, function (err, results) {
            if(results.length) {
                console.log(sql);
                console.log(item);
                res.render('search.ejs', {data: results});
            } else {
                console.log('SEARCH NOT EQUAL');
            }
        });
    }
};

