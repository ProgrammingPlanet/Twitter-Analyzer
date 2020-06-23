<style>
    @media (max-width: 640px) {
      .page-title-box .page-title-right {
        display: block !important;
        font-size: 0.7rem;
      }
    }
</style>

<!-- Start Content-->
<div class="container-fluid" id="dash" v-if="show">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    
                    <strong>Last Update - </strong>{{peoples.lastupdate}}<br>
                    <strong>Next Update - </strong>{{peoples.nextupdate}}
                    
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success">
                            <i class="fe-user-plus font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1">
                                {{peoples.newFrs.length}}
                            </h3>
                            <p class="text-muted mb-1 text-truncate">New Followers</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info">
                            <i class="fe-user-minus font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1">
                                {{peoples.newUnFrs.length}}
                            </h3>
                            <p class="text-muted mb-1 text-truncate">New Unfollowers</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-secondary">
                            <i class="fe-user-check font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">
                                {{peoples.followers.length}}
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Total Followers</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary">
                            <i class="fe-user font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">
                                {{peoples.followings.length}}
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Total Following</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border border-white">
                            <i class="fe-user-x font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">
                                {{peoples.arenotfb.length}}
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Are Not FB</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-dark">
                            <i class="fe-eye-off font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">
                                {{peoples.inotfb.length}}
                            </h3>
                            <p class="text-muted mb-1 text-truncate">I'm Not FB</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary">
                            <i class="fe-users font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">
                                {{peoples.bothside.length}}
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Both Side</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-danger">
                            <i class="fe-user-x font-22 avatar-title text-danger"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1">
                                {{peoples.blocking.length}}
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Total Blocked</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

    </div>
    <!-- end row-->
    
</div> <!-- container -->

<script type="text/javascript">

var dash = new Vue({

    el: '#dash',

    data: {
        show: true,
        peoples: {
            newFrs: [],
            newUnFrs: [],
            followers: [],
            followings: [],
            blocking: [],
            arenotfb: [],
            inotfb: [],
            bothside: [],
            lastupdate: '...',
            nextupdate: '...'
        }
    },

    methods: {
        fetchpeoples: function(){
            fetch('ajax/dashboard.php?op=fetchpeoples').then(r=>r.json())
            .then((d)=>{
                if(d.status)
                {
                    const data = d.data;
                   
                    this.peoples.newFrs = data.followers.filter(x=>!data.oflr.includes(x));
                    this.peoples.newUnFrs = data.oflr.filter(x=>!data.followers.includes(x));
                    this.peoples.arenotfb = data.followings.filter(x=>!data.followers.includes(x));
                    this.peoples.inotfb = data.followers.filter(x=>!data.followings.includes(x));
                    this.peoples.bothside = data.followings.filter(x=>data.followers.includes(x));
                    
                    this.peoples.followers = data.followers;
                    this.peoples.followings = data.followings;
                    this.peoples.blocking = data.blocking;

                    this.peoples.lastupdate = data.last_scraped;
                    this.peoples.nextupdate = data.next_scrap;

                    /* if user is new and history not saved before */
                    if(data.oflr.length == 0)
                        this.peoples.newFrs = [];

                    // console.log(data);

                    this.distributeIds();
                }
                else{
                    alert(d.msg)
                }   
            }) 
        },
        distributeIds:function(){
            newunflr.setids(this.peoples.newUnFrs);
            newflr.setids(this.peoples.newFrs);
            imnotfb.setids(this.peoples.inotfb);
            arenotfb.setids(this.peoples.arenotfb);
            bothside.setids(this.peoples.bothside);
        }
    },
    created: function(){
        this.fetchpeoples()
    }

})


</script>