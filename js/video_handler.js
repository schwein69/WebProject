function pauseAllVideos(){
    const videos = document.getElementsByTagName('video');
    for(let i=0; i<videos.length; i++){
        videos[i].pause();
    }
}
delegate_event('click', document, '.carousel-control-prev', pauseAllVideos);
delegate_event('click', document, '.carousel-control-next', pauseAllVideos);
document.addEventListener('scroll',pauseAllVideos);