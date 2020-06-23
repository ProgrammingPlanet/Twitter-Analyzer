
var head = new Vue({

	el: '#head',

	data: {
		user: {
			profile: 'assets/images/spinner.gif'
		}
	},
	methods: {
		fetchuser: function(){
			fetch('ajax/header.php?op=fetchuser')
	    	.then(resp => resp.json())
	    	.then((data)=>{
	    		if(data.status)
	    		{
	    			this.user = data.user;
	    		}
	    		else{
	    			console.log(data)
	    		}
	    	})	    
		},
		renderpic: function(url){
			return url;
		},
		logout: function(){
			fetch('ajax/header.php?op=logout',{credentials: 'include'})
			.then(resp => resp.json())
	    	.then((data)=>{
	    		if(data.status)
	    		{
	    			console.log(data.msg);
	    			// window.location.href = 'auth/login.php';
	    		}
	    	})
		}
	},
	mounted(){
    	this.fetchuser()
    }
}) 