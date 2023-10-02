<template>
    <div class="container">
        <!--<div class="row">-->
            <!--<div class="col-12">-->
                <!--<div class="card shadow-sm">-->
                    <!--<div class="card-header">-->
                        <!--<h3>Dashboard</h3>-->
                    <!--</div>-->
                    <!--<div class="card-body">-->
                        <!--<p class="mb-0">You are logged in as <b>{{user.email}}</b></p>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <textarea v-model="text"></textarea>
        <button @click="speak">Speak</button>

    </div>
</template>

<script>
    export default {
        name:"dashboard",
        data(){
            return {
                user:this.$store.state.auth.user,
                text: 'fontawesomeicons'
            }
        },
        methods: {
            speak() {
                const msg = new SpeechSynthesisUtterance();
                msg.text = this.text;
                msg.volume = 1.0; // speech volume (default: 1.0)
                msg.pitch = 1.0; // speech pitch (default: 1.0)
                msg.rate = 1.0; // speech rate (default: 1.0)
                msg.lang = 'en-US'; // speech language (default: 'en-US')
                msg.voiceURI = 'Google UK English Female'; // voice URI (default: platform-dependent)
                msg.onboundary = function (event) {
                    console.log('Speech reached a boundary:', event.name);
                };
                msg.onpause = function (event) {
                    console.log('Speech paused:', event.utterance.text.substring(event.charIndex));
                };
                window.speechSynthesis.speak(msg);
            }
        }
    }
</script>