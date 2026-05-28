// music
var tempMusic = "";
music = document.querySelector(".music");
if(tempMusic){
    music.src = tempMusic;
}

// Door mulai
function mulai(){
    // back to tap
    window.scrollTo(0, 0);

    // sound door
    var soundDoor = document.querySelector(".sound-door");
    soundDoor.play();

    // door section
    var doorSection = $("#door-section");
    var doors = document.querySelectorAll(".door");
    doors.forEach(function(door, index){
        var direction = (index === 0) ? -1 : 1
        door.style.transform = "rotateY(" + (70 *direction) + "deg)"
    })

    // set timeout
    setTimeout(function(){
        // music play
        music.play();
        doorSection.css('transform', 'scale(6)');
    }, 600);

    // set timeout door section
    setTimeout(function(){
        doorSection.css('opacity', '0');
        $('body').removeClass('overflow-hidden');
        $('body').addClass('transition');
        doorSection.css('display', 'none');
    }, 2000);
}

// buttom music
var isPlaying = true;

function toggleMusic(event){
    event.preventDefault();

    const musicButton = document.getElementById("music-button");

    if(isPlaying){
        musicButton.innerHTML = '<i class="fas fa-fw fa-pause"></i>';
        musicButton.classList.remove("rotate");
        musicButton.style.transform = "translateY(0)";
        music.pause();
    }else{
        musicButton.innerHTML = '<i class="fas fa-fw fa-compact-disc"></i>';
        musicButton.classList.add("rotate");
        music.play();
    }

    isPlaying = !isPlaying;
}

