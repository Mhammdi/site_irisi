@extends('layouts.app')

@section('content')



<div class="container" id="app2">
<div v-for="(item,index) in types">
    <div class="row">
        
            <div class="col-md-12 col-md-offset-2" >
                <div class="card text-white bg-primary mb-2">
                    
                    <div @click="change(index)" class="card-header" >
                        <div class="row">
                        <div class="col-md-7">
                            @{{item.libelle}}
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                            <div class="col-md-3">
                                        Réponses
                            </div>
                            <div class="col-md-3">
                                        Vues
                            </div>
                            <div class="col-md-3">
                                        Votes
                            </div>
                            <div class="col-md-3">
                                        Activité
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="card-body text-white bg-secondary" v-show="item.active">


                    
                    

                            <div class="row">
                                <div class="col-md-2">
                                    <img src="img/anonym.jpg" class="img-thumbnail" alt="Responsive image" width="200px" height="200px">
                                </div>
                                <div class="col-md-5">
                                    <h5 class="card-title">Que pensez vous des examins de management</h5>
                                    <p class="card-text">Par Khalil[Irisi2] 16 avril 2019 - 17:52:00 </p>
                                </div>
                                <div class="col-md-5">
                                <div class="row">
                                <div class="col-md-3">
                                            5
                                </div>
                                <div class="col-md-3">
                                            15
                                </div>
                                <div class="col-md-3">
                                            3
                                </div>
                                <div class="col-md-3">
                                            18-5-9999
                                </div>
                                </div>
                                </div>
                            </div>

                            <hr/>

                            <div class="row">
                                <div class="col-md-2">
                                    <img src="img/anonym.jpg" class="img-thumbnail" alt="Responsive image">
                                </div>
                                <div class="col-md-5">
                                    <h5 class="card-title">Que pensez vous des examins de management</h5>
                                    <p class="card-text">Par Khalil[Irisi2] 16 avril 2019 - 17:52:00 </p>
                                </div>
                                <div class="col-md-5">
                                <div class="row">
                                <div class="col-md-3">
                                            5
                                </div>
                                <div class="col-md-3">
                                            15
                                </div>
                                <div class="col-md-3">
                                            3
                                </div>
                                <div class="col-md-3">
                                            18-5-9999
                                </div>
                                </div>
                                </div>
                                
                            </div>

                            <hr/> 
                       
                    </div>
                    <div class="card-footer ">
                        <a v-bind:href="/gettype/+item.id" class="btn btn-secondary" >Show More</a>
                    </div> 
                     
                    
                </div> 
            </div>
    </div>
        
        
        
</div>      
</div>










@endsection


@section('javascripts')

<script src="js/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

    

    Vue.config.devtools = true;

    var app = new Vue({
        el:"#app2",
        data:{
            test:'khalil',
            list:[
                {
                    active:true,
                    name :"khalil"
                },
                {
                    active:false,
                    name :"Younes"
                }
                
                ],
            types:[],
            active:[],
            act:true
        },
        methods:{
            change:function(index){
                this.types[index].active=!this.types[index].active;
                console.log(this.types);
            },
            getTypes:function(){
                axios.get('http://localhost:8000/getTypes')
                .then(response => {
                    this.types=response.data;
                    active=false;
                    for(var i=0;i<this.types.length;i++){
                        this.types[i].active=true;
                        
                    }
                    console.log(this.types);
                })
                .catch(error => {
                    console.log(error)
                })
            }
        },
        mounted:function(){
            
            this.getTypes();
            
            


        }
    });
    


</script>




@endsection