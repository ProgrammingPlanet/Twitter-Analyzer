<div class="container-fluid px-0" id="tool-converter" v-if="show">
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
			    <input type="text" class="form-control" placeholder="Enter @username or Twitter id" v-model="input" v-on:input="validate" v-on:keyup.enter="onEnter">
			    <div class="input-group-append">
			        <button class="btn btn-success waves-effect waves-light" v-on:click="fetch" v-bind:disabled="btn.disabled">
			        	{{btn.text}} <span class="spinner-border spinner-border-sm" v-if="btn.text==''"></span>
			        </button>
			    </div>
			</div>
		</div>

        <transition name="fade">
		<div class="col-12 col-sm-12 col-md-10 col-lg-8 mx-auto mt-2" v-if="seeresult">

			<div class="card-box">
                <h4 class="mb-2 text-center">Result</h4>
                <div class="mx-auto">
                    <table class="table table-borderless text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>input</th>
                                <th>output</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{input}}</td>
                                <td>{{query.user_ids ? '@'+result.screen_name : result.id}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
	        </div>

        </div>
        </transition>


    </div><!-- end component -->
</div>

<script>
	
	var converter = new Vue({

        el: '#tool-converter',
        data: {
        	show: false,
        	seeresult: false,
        	title: "Twitter id/UserName Converter",
            input: "",
            query: {},
            result: {},
            btn: {disabled:true,text:'Submit'}
        },
        methods: {
        	filterinput: function(){
                if(this.input[0]=='@'){
                    this.query = {screen_names: this.input.replace('@','')};
                }
                else{
                    this.query = {user_ids: this.input};
                }
        	},
        	onEnter: function(){
        		if(!this.btn.disabled) this.fetch();
        	},
	        validate: function(){

	            var rx = /^(@[A-Za-z_0-9]{1,14})|([0-9]{1,25})$/;

	            this.seeresult = false;

	            if(this.input.match(rx))
	            {
	            	this.btn.disabled = false;
	            }
	            else{
	            	this.btn.disabled = true;
	            }     
	        },
	        fetch: function(){

            	this.btn = {disabled:true,text:''};
            	this.seeresult = false;

            	this.filterinput();

            	axios({
	              	method: 'post',
	              	url: 'ajax/tools.php',
	              	params: {op:'convert',query:this.query}
	            })
	            .then((r)=>{
	              	var res = r.data;
	              	if(res.status){
	                	this.result = res.user;
	                	this.seeresult = true;
	              	}
	              	else{
	                	alert('Server Error: '+ res.msg);
	              	}
	              	console.log(res);
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