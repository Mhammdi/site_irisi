@extends('layouts.app')

@section('content')



<div class="container" id="app2">
    <div v-for="(type,index2) in types">
        <div class="row">

            <div class="col-md-12 col-md-offset-2">
                <div class="card text-white bg-primary mb-2">

                    <div @click="change(index2)" class="card-header">
                        <div class="row">
                            <div class="col-md-7">
                                @{{type.libelle}}
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <center>Réponses</center>
                                    </div>
                                    <div class="col-md-3">
                                        <center> Vues</center>
                                    </div>
                                    <div class="col-md-3">
                                        <center>Votes</center>
                                    </div>
                                    <div class="col-md-3">
                                        <center>Activité</center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-for="(item,index) in sujets" v-if="active[index2]">
                        <div class="card-body text-primary bg-light" v-if="item.type_sujet_id==type.id">
                            <div class="row text-primary">
                                <div class="col-md-2">
                                    <img v-bind:src="users[index].photo" class="img-thumbnail" alt="Responsive image" width="200px" height="200px">
                                </div>
                                <div class="col-md-5">
                                    <a v-bind:href="getHref(item.id)">
                                        <h5 class="card-title">@{{item.question}}</h5>
                                    </a>
                                    <p class="card-text">Par @{{users[index].name}}
                                        <strong v-if="users[index].profession">[@{{users[index].profession}}]</strong>
                                        @{{item.created_at}}
                                        <br>
                                        <div> @{{getDescription(item.description)}}</div>
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <center>@{{reponses[index]}}</center>
                                        </div>
                                        <div class="col-md-3">
                                            <center>@{{item.vues}}</<center>
                                        </div>
                                        <div class="col-md-3">
                                            <center>@{{votes[index]}}</<center>
                                        </div>
                                        <div class="col-md-3">
                                            <center>@{{activites[index]}}</<center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="card-footer ">
                        <a v-bind:href="getUrl(type.id)" class="btn btn-info">Show More</a>
                    </div>
                </div>
            </div>
            </>



        </div>
    </div>










    @endsection


    @section('javascripts')


    <script>
        Vue.config.devtools = true;

        var app = new Vue({
            el: "#app2",
            data: {
                test: 'khalil',
                sujets: [],
                sujet: {
                    id: "",
                    created_at: "",
                    description: "",
                    vue: "",
                    question: "",
                    type_id: 0
                },
                types: [],
                active: [],
                users: [],
                votes: [],
                reponse: [],
                activites: []
            },
            methods: {
                change: function(index) {
                    //alert(this.active[index]);
                    Vue.set(this.active, index, !this.active[index])

                },
                getHref: function(index) {
                    return "/Sujet" + index;
                },
                getDescription: function(description) {
                    if (description.length > 300) {
                        return description.substring(0, 200) + "...";
                    } else {
                        return description;
                    }
                },
                getUrl: function(item) {
                    return "/getType" + item + "";
                },
                getTypes: function() {
                    axios.get('http://localhost:8000/getTypes')
                        .then(response => {
                            this.types = response.data;
                            for (var i = 0; i < this.types.length; i++) {
                                this.active[i] = true;
                            }

                            console.log(this.types);
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },
                getSujets: function() {


                    axios.get("http://localhost:8000/getSujets")
                        .then(response => {
                            this.sujets = response.data.sujets;
                            this.users = response.data.users;
                            this.votes = response.data.reactions;
                            this.reponses = response.data.reponses;
                            this.activites = response.data.activites;
                            console.log(response.data);


                        })
                        .catch(error => {
                            console.log(error)
                        })
                }

            },
            mounted: function() {

                this.getTypes();
                this.getSujets();




            }
        });
    </script>




    @endsection