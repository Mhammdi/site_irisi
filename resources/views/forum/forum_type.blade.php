@extends('layouts.app')

@section('content')



<div class="container" id="app3">
    <div id="getType" ref="getType" style="display : none;">{{$types->id}}</div>


    <div class="row">

        <div class="col-md-12 col-md-offset-2">
            <div class="card text-white bg-primary mb-2">

                <div @click="change(index)" class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            @{{types.libelle}}
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
                <div v-for="(item,index) in sujets">

                    <div class="card-body text-primary bg-light">
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
                                        @{{reponses[index]}}
                                    </div>
                                    <div class="col-md-3">
                                        @{{item.vues}}
                                    </div>
                                    <div class="col-md-3">
                                        @{{votes[index]}}
                                    </div>
                                    <div class="col-md-3">
                                        @{{activites[index]}}
                                    </div>
                                </div>
                            </div>


                            <hr />

                        </div>
                        <hr />
                    </div>
                </div>
                <div class="card-body text-primary bg-light" v-show="active">
                    <form v-on:submit.prevent="save">
                        <div class="form-group">
                            <label for="question">Question/Sujet</label>
                            <input type="text" class="form-control" id="question" placeholder="Veuillez Entrez Votre Question ici !!" v-model="sujet.question">
                        </div>


                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" v-model="sujet.description"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="form-control btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>


                <div class="card-footer ">
                    <button class="btn btn-info" @click="active=!active">Ajouter une Question</button>
                </div>


            </div>
        </div>




    </div>










    @endsection


    @section('javascripts')


    <script>
        Vue.config.devtools = true;

        var app = new Vue({
            el: "#app3",
            data: {
                test: 'khalil',
                id: 0,
                types: [],
                sujets: [],
                active: false,
                sujet: {
                    id: "",
                    created_at: "",
                    description: "",
                    vue: "",
                    question: "",
                    type_id: 0,

                },

                users: [],
                votes: [],
                reponse: [],
                activites: []



            },

            methods: {
                change: function(index) {
                    this.types[index].active = !this.types[index].active;
                    console.log(this.types);
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
                photo: function(img) {
                    return "img/" + img;
                },
                getUrl: function(item) {
                    return "/getType" + item + "";
                },
                save: function() {
                    this.sujet.type_id = this.id;
                    axios.post("http://localhost:8000/sujet", this.sujet)
                        .then(response => {
                            this.sujets.push(response.data.sujet);
                            this.users.push(response.data.user);
                            this.active = false;
                            this.sujet = {
                                id: "",
                                created_at: "",
                                description: "",
                                vue: "",
                                question: "",
                                type_id: 0
                            };
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },
                getTypes: function() {
                    this.id = this.$refs.getType.innerText;

                    axios.get("http://localhost:8000/Type" + this.id)
                        .then(response => {
                            this.types = response.data;
                        })
                        .catch(error => {
                            console.log(error)
                        })
                },
                getSujets: function() {
                    this.id = this.$refs.getType.innerText;

                    axios.get("http://localhost:8000/sujet" + this.id)
                        .then(response => {
                            this.sujets = response.data.sujets;
                            this.users = response.data.users;
                            this.votes = response.data.reactions;
                            this.reponses = response.data.reponses;
                            this.activites = response.data.activites;

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