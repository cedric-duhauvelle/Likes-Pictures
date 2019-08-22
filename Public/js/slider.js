class Slider{

    constructor(element) {
        this.element = element;
        this.slideIndex = 1;
        this.sliderStart = 0;

        this.showSlidesX(this.slideIndex);
        this.SaveShowSlides = setInterval(() => {
            this.plusSlides(1)
        }, 5000);
        
        this.createNavigation();
        this.navigationKeyboard();   
    };

    /**
    * @description ajout de la navigation sur clavier
    */
    navigationKeyboard() {
        addEventListener('keyup', e => {
            if (e.key === 'ArrowRight' || e.key === 'Right') {
                this.next();
            } else if (e.key === 'ArrowLeft' || e.key === 'Left') {
                this.prev();
            };
        });
    };

    /**
    * @description verifie si le defilement du slider est actif
    */
    checkScrollingSlider() {
        if (this.sliderStart === 0) {
            this.stop();
            this.start();
        };
    };

    /**
    * @description permet le changement de slide
    */
    plusSlides(n) {
        this.showSlidesX(this.slideIndex += n);
    };

    /**
    * @description evenement du bouton "next"
    */
    next() {
        this.checkScrollingSlider();
        this.plusSlides(1);
    };

    /**
    * @description evenement du bouton "prev"
    */
    prev() {
        this.checkScrollingSlider();
        this.plusSlides(-1);
    };

    /**
    * @description creation du defilement
    */
    showSlidesX(n) {
        let i;
        let slides = document.getElementsByClassName("slider_content");
        if (n > slides.length) {
            this.slideIndex = 1;
        };
        if (n < 1) {
            this.slideIndex = slides.length;
        };
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none"; 
        };
        slides[this.slideIndex-1].style.display = "block";
        return this.slideIndex;
    };

    /**
    * @description creation des bouttons de navigation
    */
    createNavigation() {

        //creation du bouton next
        let nextButton = this.createDivWithClass('slider_next');
        let nextImg = document.createElement('img');
        nextImg.src = 'img/chevron_droit.png';
        nextButton.appendChild(nextImg);

        //creation du bouton prev
        let prevButton = this.createDivWithClass('slider_prev');
        let prevImg = document.createElement('img');
        prevImg.src = 'img/chevron_gauche.png';
        prevButton.appendChild(prevImg);

        //creation du bouton stop et start
        this.buttonStop = this.createDivWithClass('slider_stop');
        let buttonStopContent = this.createDivWithClass('slider_button_stop_start');
        buttonStopContent.appendChild(this.buttonStop);
        this.element.appendChild(buttonStopContent);
        this.element.appendChild(nextButton);
        this.element.appendChild(prevButton);

        //ajout evenement sur les boutons
        this.buttonStop.addEventListener('click', this.buttonStopStart.bind(this));
        nextButton.addEventListener('click', this.next.bind(this));
        prevButton.addEventListener('click', this.prev.bind(this));
    };

    /**
    * @description arret le slider
    */
    stop() {    
        window.clearInterval(this.SaveShowSlides);
    };

    /**
    * @description demare le defilement du carousel
    */
    start() {
        this.SaveShowSlides = window.setInterval(() => this.plusSlides(1), 5000);
    };

    /**
    * @description arret ou relance le defilement
    */          
    buttonStopStart() {
        if (this.sliderStart === 0) {
            this.stop();
            this.buttonStop
                .classList
                .remove('slider_stop')
            ;
            this.buttonStop
                .classList
                .add('slider_play')
            ;
            this.sliderStart++;
        } else if (this.sliderStart === 1) {
            this.start();
            this.buttonStop
                .classList
                .remove('slider_play')
            ;
            this.buttonStop
                .classList
                .add('slider_stop')
            ;
            this.sliderStart--;
        };
    };

    /**
    * @param {string} className
    * @return {HTMLElement} 
    */
    createDivWithClass(className) {
        let div = document.createElement('div');
        div.setAttribute('class', className);
        return div;
    };       
};