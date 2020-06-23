<div class="container-fluid px-0" id="tool-relations" v-if="show">
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
                <input type="text" class="form-control" placeholder="@source" v-model="u1" v-on:input="validate" v-on:keyup.enter="onEnter">
			    <input type="text" class="form-control" placeholder="@target" v-model="u2" v-on:input="validate" v-on:keyup.enter="onEnter">
			    <div class="input-group-append">
			        <button class="btn btn-success waves-effect waves-light" v-on:click="fetch" v-bind:disabled="btn.disabled">
			        	{{btn.text}} <span class="spinner-border spinner-border-sm" v-if="btn.text==''"></span>
			        </button>
			    </div>
			</div>
		</div>
        <transition name="fade">
		<div class="col-12 col-sm-12 col-md-10 col-lg-10 mx-auto mt-2" v-if="seeresult">

			<div class="card-box">
                <h4 class="header-title mb-2 text-center">Relations</h4>
                <table class="table table-borderless table-responsive mt-3">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>Handle</th>
                            <th>Following</th>
                            <th>Notification</th>
                            <th>DM</th>
                            <th>Blocking</th>
                            <th>Muting</th>
                            <th>Marked Spam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Source</th>
                            <td>{{relationship.u1.id_str}}</td>
                            <td>@{{relationship.u1.screen_name}}</td>
                            <td>{{relationship.u1.following ? '✓' : 'x'}}</td>
                            <td>{{relationship.u1.notifications_enabled ? '✓' : 'x'}}</td>
                            <td>{{relationship.u1.can_dm ? '✓' : 'x'}}</td>
                            <td>{{relationship.u1.blocking ? '✓' : 'x'}}</td>
                            <td>{{relationship.u1.muting ? '✓' : 'x'}}</td>
                            <td>{{relationship.u1.marked_spam ? '✓' : 'x'}}</td>
                        </tr>
                        <tr>
                            <th>Target</th>
                            <td>{{relationship.u2.id_str}}</td>
                            <td>@{{relationship.u2.screen_name}}</td>
                            <td>{{relationship.u2.following ? '✓' : 'x'}}</td>
                            <td>{{relationship.u2.notifications_enabled ? '✓' : 'x'}}</td>
                            <td>{{relationship.u2.can_dm ? '✓' : 'x'}}</td>
                            <td>{{relationship.u2.blocking ? '✓' : 'x'}}</td>
                            <td>{{relationship.u2.muting ? '✓' : 'x'}}</td>
                            <td>{{relationship.u2.marked_spam ? '✓' : 'x'}}</td>
                        </tr>
                    </tbody>
                </table>
	        </div>

        </div>
        </transition>


    </div><!-- end component -->
</div>

<script>
	
	var relations = new Vue({

        el: '#tool-relations',
        data: {
        	show: false,
        	seeresult: false,
        	title: "Get Relationship between Two Users",
            u1: "",
            u2: "",
        	relationship: {},
            btn: {disabled:true,text:'Submit'}
        },
        methods: {
        	onEnter: function(){
        		if(!this.btn.disabled) this.fetch();
        	},
	        validate: function(){
	            var rx = /^(@[A-Za-z_0-9]{1,14})$/;

	            this.seeresult = false;

	            if(this.u1.match(rx) && this.u2.match(rx))
	            {
	            	this.btn.disabled = false;
	            }
	            else{
	            	this.btn.disabled = true;
	            }
	            // console.log(this.tlink.match(r_link));            
	        },
	        fetch: function(){

            	this.btn = {disabled:true,text:''};
            	this.seeresult = false;

            	axios({
	              	method: 'post',
	              	url: 'ajax/tools.php',
	              	params: {op:'getrelation',u1:this.u1,u2:this.u2}
	            })
	            .then((r)=>{
	              	var res = r.data;
	              	if(res.status){
	                	this.relationship = res.data;
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