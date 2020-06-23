<div class="container-fluid px-0" id="tool-retweeters" v-if="show">
	<!-- start page title -->
    <div class="row">
        <div class="col-12 text-center">
            <div class="page-title-box">
                <h4 class="page-title">{{title}}</h4>
            </div>
        </div>
    </div>  
	<!-- end page title -->

	<!-- start component -->
    <div class="row">
		<div class="col-12 col-sm-10 col-md-8 col-lg-8 mx-auto my-3">
    		<div class="input-group">
			    <input type="text" class="form-control" placeholder="Enter Tweet link" v-model="tlink" v-on:input="validate" v-on:keyup.enter="onEnter">
			    <div class="input-group-append">
			        <button class="btn btn-success waves-effect waves-light" v-on:click="getretweeters" v-bind:disabled="btn.disabled">
			        	{{btn.text}} <span class="spinner-border spinner-border-sm" v-if="btn.text==''"></span>
			        </button>
			    </div>
			</div>
		</div>
        
        <transition name="fade">
		<div class="col-12 col-sm-12 col-md-10 col-lg-8 mx-auto mt-2" v-if="seeresult">

			<div class="card-box">
                <h4 class="header-title mb-2 text-center">Retweeters</h4>
                <ul class="nav nav-tabs nav-bordered nav-justified">
                    <li class="nav-item">
                        <a href="#rtrs-list" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#rtrs-details" data-toggle="tab" aria-expanded="true" class="nav-link">
                            Details
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="rtrs-list">
                        <ul>
                        	<li v-for="(rtr,i) of rtrs">@{{rtr.uname}}</li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="rtrs-details">
                        <table class="table table-borderless table-responsive mb-0">
                            <thead class="thead-light">
	                            <tr>
	                                <th>S No.</th>
	                                <th>Twitter id</th>
	                                <th>Name</th>
	                                <th>Twitter Handle</th>
	                            </tr>
                            </thead>
                            <tbody>
	                            <tr v-for="(rtr,i) of rtrs">
	                                <th scope="row">{{i+1}}</th>
	                                <td>{{rtr.id}}</td>
	                                <td>{{rtr.name}}</td>
	                                <td>@{{rtr.uname}}</td>
	                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
	        </div>

        </div>
        </transition>


    </div><!-- end component -->
</div>

<script>
	
	var retweeters = new Vue({

        el: '#tool-retweeters',
        data: {
        	show: false,
        	seeresult: false,
        	title: "Get Retweeters Of A Tweet",
        	tlink: "",
            rtrs: [],
            btn: {disabled:true,text:'Submit'}
        },
        methods: {
        	linktoid: function(link){
        		// only effective in case of url else no effect
        		var link = link.split('/').pop();
	            return link.slice(0,link.indexOf('?'));
        	},
        	onEnter: function(){
        		if(!this.btn.disabled) this.getretweeters();
        	},
	        validate: function(){
	            var r_link = /^http(s)?:\/\/(twitter\.com)\/[A-Za-z_0-9]{5,15}\/(status)\/[0-9]{10,}(\?s=[0-9]*)?$/;
	            var r_id = /^[0-9]{5,}$/;

	            this.seeresult = false;

	            if(this.tlink.match(r_link) || this.tlink.match(r_id))
	            {
	            	this.btn.disabled = false;
	            }
	            else{
	            	this.btn.disabled = true;
	            }
	            // console.log(this.tlink.match(r_link));            
	        },
	        getretweeters: function(){

            	this.btn = {disabled:true,text:''};
            	this.seeresult = false;

            	var id = this.linktoid(this.tlink);

            	axios({
	              	method: 'post',
	              	url: 'ajax/tools.php',
	              	params: {op:'getretweeters',tweetid:id}
	            })
	            .then((r)=>{
	              	var res = r.data;
	              	if(res.status){
	                	this.rtrs = res.retweeters;
	                	this.seeresult = true;
	              	}
	              	else{
	                	alert('Server Error: '+ res.msg);
	              	}
	              	// console.log(res);
	            })
	            .then(()=>{
	            	this.btn = {disabled:false,text:'Submit'};
	            })
	        }
        },
        created: function(){

        }
    })

</script>