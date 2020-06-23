<div class="container-fluid px-0" id="newfollowers" v-if="show">
	<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <strong>Last Update - </strong><br>
                    <strong>Next Update - </strong>
                </div> -->
                <h4 class="page-title">{{title}}</h4>
            </div>
        </div>
    </div>  
	<!-- end page title -->

	<!-- start newfollowers component -->
    <div class="row">
		<div class="col-12 my-5 text-center" v-if="!users.length">
			<div class="spinner-border text-warning" v-if="isloading"></div>
			<h3 class="text-warning" v-else>
				Nothing To Show Here :(
			</h3>
		</div>
		<div class="col-12 col-sm-8 col-md-6 col-lg-4" v-for="user in users">
    		<!-- card-box-->
		    <div class="card mb-1">
		        <div class="card-body p-2">
		        	<div class="row">
		        		<div class="col-3 col-sm-3 col-md-3 col-lg-3 text-center">
		        			<img v-bind:src="getstr(user.dp_url)" class="img-fluid avatar-md rounded-circle">
		        		</div>
		        		<div class="col-9 col-sm-9 col-md-9 col-lg-9">
		        			<div class="row">
		        				<div class="col-7 col-lg-7">
		        					<div class="row">
		        						<div class="col-10 px-0 text-truncate">
		        							<span> {{user.name}} </span>
		        						</div>
		        						<div class="col-2 px-1">
		        							<img src="assets/images/bt.png" width="15" v-if="user.verified">
		        						</div>
		        						<div class="col-12 px-0">
		        							<a v-bind:href="'http://twitter.com/'+user.username" target="_blank">
		        								@{{user.username}}
		        							</a>
		        						</div>
		        					</div>
		        				</div>
		        				<div class="col-5 col-lg-5 text-right">
		        					<button type="button" v-on:click="togglefollow(`${user.id}`)"  v-bind:class="['btn-'+(user.following?'':'outline-')+'info']" class="btn btn-sm btn-rounded waves-effect waves-light">
		        						{{user.following ? 'Following' : 'Follow'}}
		        					</button>
		        				</div>
		        			</div>
		        			<div class="row">
	        					<div class="col-12 col-lg-12 px-0">
	        						Followers: {{user.followers_count}}
	        					</div>
	        				</div>
		        		</div>
		        	</div>
		        </div>
		    </div> <!-- end card-box-->
		</div>
		<div class="col-12 mt-3 text-center" v-if="users.length && !isloading">
			<button type="button" class="btn btn-success waves-effect waves-light" v-on:click="fetchusers">
				Load More
			</button>
		</div>
    </div><!-- start newfollowers component -->
</div>

<script>

	
	
	var newflr = new Vue({

        el: '#newfollowers',
        data: {
        	show: false,
        	isloading: true,
        	title: "New Followers",
            ids: [],
            users: [],
            lastfetched: "",
            chuncksize: 9
        },
        methods: {
        	getstr: function(v){
        		return v;
        	},
            setids: function(ids){
                this.ids = ids;  
                this.isloading = false; 
            },
            fetchusers: function(){

            	return fetchusers(this);
	        },
	        togglefollow: function(id){

	        	return togglefollow(this,id);
	        }
        },
        watch:{
        	ids: function(ids){		//when first time ids will be assigned
        		this.fetchusers();
        	}
        },
        created: function(){
            // this.fetchusers()
        }
    })

</script>