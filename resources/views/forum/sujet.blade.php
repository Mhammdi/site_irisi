@extends('layouts.app')

@section('content')


<div class="container" id="app3">
    <div id="getType" ref="getType" style="display : none;">{{$id}}</div>
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="card text-white bg-primary mb-2">
                <div class="card-header">
                    <div class="row text-white">
                        <div class="col-md-2">
                            <center><img v-bind:src="user.photo" class="img-thumbnail" alt="Responsive image" width="100px" height="100px"></center>
                        </div>
                        <div class="col-md-8">

                            <h3 class="card-title">@{{sujet.question}}</h3>

                            <p class="card-text">Par @{{user.name}}
                                <strong v-if="user.profession">[@{{user.profession}}]</strong>
                                @{{sujet.created_at}}
                            </p>
                        </div>
                        <div class="col-md-2">
                            <center>
                                <div class="col-md-12"><img v-bind:src="arrowUp" <?php if (Auth::user()) { ?>@click="clickedUp()" v-on:mouseover="hoverUp()" v-on:mouseleave="leaveUp()" <?php } ?>width="30px" height="30px"></div>
                                <div class="col-md-11">@{{react}}</div>
                                <div class="col-md-12"><img v-bind:src="arrowDown" <?php if (Auth::user()) { ?> @click="clickedDown()" v-on:mouseover="hoverDown()" v-on:mouseleave="leaveDown()" <?php } ?> width="30px" height="30px"></div>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="card-body text-primary bg-light">
                    <div class="row" style="padding:40px">
                        <p class="lead font-weight-light" style="line-height: 1.9;white-space: pre-line;text-indent: 40px;"> @{{sujet.description}}</p>
                    </div>
                    <br>
                    <hr />

                </div>

                <br>



                <div class="card-body text-primary bg-light">
                    <form v-on:submit.prevent="save">
                        <div class="form-group">
                            <label for="reponse">Reponse</label>
                            <textarea class="form-control" id="reponse" rows="3" v-model="repo.rep"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="form-control btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>
                <div v-for="(item,index) in reponses" v-show="showReponses">
                    <div class="card-body text-primary bg-light">
                        <div class="row text-primary">
                            <div class="col-md-2">
                                <img v-bind:src="ReponsesUsers[index].photo" class="img-thumbnail" alt="Responsive image" width="200px" height="200px">
                            </div>
                            <div class="col-md-5">
                                <p class="card-text">Par @{{ReponsesUsers[index].name}}
                                    <strong v-if="ReponsesUsers[index].profession">[@{{ReponsesUsers[index].profession}}]</strong>
                                    @{{item.created_at}}
                                    <br>
                                    <div>@{{item.reponse}}</div>
                                </p>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <br>
                </div>

                <div class="card-footer ">
                    <button class="btn btn-info" @click="showReponses=!showReponses"> <Strong>Réactions @{{ReponsesUsers.length}}</Strong></button>
                </div>
            </div>

        </div>

    </div>
</div>




@endsection


@section('javascripts')

<script>
    Vue.config.devtools = true;
    new Vue({
        el: "#app3",
        data: {
            id: 0,
            sujet: '',
            user: '',
            showForm: false,
            showReponses: false,
            repo: {
                rep: '',
                sujet_id: 0,
            },
            ReponsesUsers: [],
            reponses: [],
            react: 0,
            arrowUp: "icons/arrow-up.png",
            arrowDown: "icons/arrow-down.png",
            clickUp: false,
            clickDown: false,
            reaction: {
                sujet_id: 0,
                user_id: 0,
                react: 0
            }


        },
        methods: {
            hoverUp: function() {
                this.arrowUp = "icons/arrow-green.png";
            },
            leaveUp: function() {
                if (!this.clickUp) {
                    this.arrowUp = "icons/arrow-up.png";
                }
            },
            clickedUp: function() {
                if (!this.clickUp) {
                    this.arrowUp = "icons/arrow-green.png";
                    this.clickUp = true;
                    this.arrowDown = "icons/arrow-down.png";
                    if (this.clickDown) {
                        this.react++;
                        this.reaction.react++;
                        this.clickDown = false;
                    }
                    this.reaction.react++;
                    this.react++;
                } else {
                    this.arrowUp = "icons/arrow-up.png";
                    this.clickUp = false;
                    this.react--;
                    this.reaction.react--;
                }
                this.reaction.sujet_id = this.id;
                axios.post("http://localhost:8000/reaction", this.reaction)
                    .then(response => {

                        this.reaction = response.data.reaction;

                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            hoverDown: function() {
                this.arrowDown = "icons/arrow-red.png";
            },
            leaveDown: function() {
                if (!this.clickDown) {
                    this.arrowDown = "icons/arrow-down.png";
                }
            },
            clickedDown: function() {
                if (!this.clickDown) {


                    this.arrowDown = "icons/arrow-red.png";
                    this.clickDown = true;
                    this.arrowUp = "icons/arrow-up.png";
                    if (this.clickUp) {
                        this.react--;
                        this.reaction.react--;
                        this.clickUp = false;
                    }
                    this.reaction.react--;
                    this.react--;
                } else {
                    this.arrowDown = "icons/arrow-down.png";
                    this.clickDown = false;
                    this.reaction.react++;
                    this.react++;


                }
                this.reaction.sujet_id = this.id;
                console.log(this.reaction);
                axios.post("http://localhost:8000/reaction", this.reaction)
                    .then(response => {
                        this.reaction = response.data.reaction;


                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            getSujet: function() {

                this.id = this.$refs.getType.innerText;
                console.log(this.id);
                axios.get("http://localhost:8000/getSujet" + this.id)
                    .then(response => {
                        this.sujet = response.data.sujet;
                        this.user = response.data.sujet.user;
                        this.reponses = response.data.sujet.reponses;
                        this.ReponsesUsers = response.data.reponsesUsers;
                        this.react = response.data.reactionNumber;
                        if (response.data.reaction != 0) {
                            this.reaction = response.data.reaction;
                        } 
                        

                        console.log(this.reaction);
                        if (this.reaction.react > 0) {
                            this.arrowUp = "icons/arrow-green.png";
                            this.clickUp = true;
                        } else if (this.reaction.react < 0) {
                            this.arrowDown = "icons/arrow-red.png";
                            this.clickDown = true;
                        }



                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            save: function() {
                this.repo.sujet_id = this.id;
                axios.post("http://localhost:8000/reponse", this.repo)
                    .then(response => {
                        this.reponses.unshift(response.data.reponse);
                        this.ReponsesUsers.unshift(response.data.reponse.user);
                        this.showReponses = true;
                        this.showForm = false;
                        this.repo.rep = "";

                    })
                    .catch(error => {
                        console.log(error)
                    })
            }

        },
        mounted: function() {
            this.getSujet();

        }




    })
</script>



@endsection