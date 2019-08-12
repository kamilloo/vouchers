<template>
</template>
<script>
    import Stepper from 'bs-stepper'

    export default {
     mounted () {

         document.addEventListener('DOMContentLoaded', function () {
             window.stepper = new Stepper(document.querySelector('.bs-stepper'),{
                 linear: false,
                 animation: true,
                 selectors: {
                     steps: '.step',
                     trigger: '.step-trigger',
                     stepper: '.bs-stepper'
                 }
             })
         })

         window.stepper_next = function ()
         {
             window.stepper.next();
         }

         window.stepper_previous = function () {
             window.stepper.previous();
         }
     }


 }
</script>