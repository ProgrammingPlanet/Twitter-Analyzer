function fetchusers(self)
{

	self.isloading = true;

	var st = self.ids.indexOf(self.lastfetched)+1;
	var t = self.ids.slice(st,st+self.chuncksize);
	
	if(t.length==0){
		self.isloading = false; 
		return console.log('No More Records');
	}
	
	axios({
      	method: 'post',
      	url: 'ajax/dashboard.php',
      	params: {op:'fetchusers',userids:t}
    })
    .then((r)=>{
    	var res = r.data;              	
      	if(res.status){
      		self.users = self.users.concat(res.users);	//update with new merged with olds
      		self.lastfetched = t.pop();
        	// console.log(res);
      	}
      	else{
        	alert('Server Error: '+ res.msg);
      	}
    })
    .then((x)=>{
    	self.isloading = false;
    })
}


function togglefollow(self,id)
{
	var user = self.users.find(o => o.id === id); //return the pointer(refrence) to that user object

	axios({
      	method: 'post',
      	url: 'ajax/dashboard.php',
      	params: {op:'togglefollow',userid:id,isfollowing:user.following}
    })
    .then((r)=>{
    	var res = r.data;   
    	    	
      	if(res.status){
      		user.following = !(user.following);
        	console.log(res);
      	}
      	else{
        	alert('Server Error: '+ res.msg);
      	}
      	// console.log(res);
    })
}
