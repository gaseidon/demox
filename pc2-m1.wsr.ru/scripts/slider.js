let slider = {
    timer: "",
    n: 0,
    slide: function() {
        let width = $(".slide").outerWidth()+20; //размер слайда
        if(this.n == 3) this.n = 0; //если больше 2-ух пролистываний, вернуться в начальное положение
        $(".slides").css('right', `${width * this.n}px`); //пролистывание слайдера
        this.timer = setTimeout(() => this.slide(this.n++), 3000); //время, через которое переключается слайд
    }
}
slider.slide();

