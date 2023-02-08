require('./bootstrap');

Echo.channel('DanskeBankVisitorEvent')
    .listen('visitorEvent', (e) => {
        console.log('visitor event:',e)
        const audio = new Audio('sound/sound1.mp3');
        audio.play();
        toastr.success('User visiting');
    });

Echo.channel('DanskeBankStoreEvent')
    .listen('storeEvent', (e) => {
        console.log('store event:',e)
        const audio = new Audio('sound/sound2.mp3');
        audio.play();
        toastr.success('User detail stored');
    });