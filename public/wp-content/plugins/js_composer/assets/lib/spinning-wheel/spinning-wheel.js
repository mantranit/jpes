//constants
var ID_CONTAINER = 'wheel';
var MAX_ANGULAR_VELOCITY = 360 * 5;
var WHEEL_RADIUS = 260;
var ANGULAR_FRICTION = 0.18;
var BORDER_OUTSIDE = 6;
var IMG_WIDTH = 220;
var IMG_HEIGHT = IMG_WIDTH;
var FONT_SIZE = 14;
var BACKGROUND_NORMAL = '#A80000';
var BACKGROUND_ACTIVE = '#810101';

/*var DATA_WHEEL = [
    {text: 'MARKETING\nOnline &\nOffline', image: '/img/branding00.png'},
    {text: 'BRANDING', image: '/img/branding01.png'},
    {text: 'WEBSITE\nUX/UI', image: '/img/branding02.png'},
    {text: 'SEO &\nMEDIA', image: '/img/branding03.png'},
    {text: 'MEDIA\nBUYING', image: '/img/branding04.png'},
    {text: 'BUSINESS &\nPARTNERSHIPS\nDEVELOPMENT', image: '/img/branding05.png'},
    {text: 'RESEARCH\nREPORT &\nANALYTICS', image: '/img/branding06.png'},
    {text: 'COMMUNICATION\nPLANNING', image: '/img/branding07.png'},
    {text: 'CREATIVE\nCONTENT', image: '/img/branding08.png'},
    {text: 'SOCIAL\nMEDIA', image: '/img/branding09.png'}
];*/
var NUM_WEDGES = 0;

// to improve performance to loading image
if (typeof DATA_WHEEL != 'undefined')
    loadFirst();
function loadFirst() {
    var div = document.createElement('div');
    div.style.display = 'none';
    document.body.appendChild(div);
    for (var index in DATA_WHEEL){
        var img = document.createElement('img');
        img.src = DATA_WHEEL[index].image;
        img.width = 1;
        img.height = 1;
        div.appendChild(img);
    }
}

// globals
var angularVelocity = 360;
var lastRotation = 0;
var controlled = false;
var egdeText = 0;
var textList = [];
var wedgeBackgroundList = [];
var clickSlider = false;

var wheelSlider, target, activeWedge, stage, layer, wheel, imageObj, startRotation, startX, startY;

function bind() {
    wheel.on('mousedown', function(evt) {
        var mousePos = stage.getPointerPosition();
        angularVelocity = 0;
        controlled = true;
        target = evt.targetNode;
        startRotation = this.rotation();
        startX = mousePos.x;
        startY = mousePos.y;
    });
    // add listeners to container
    document.body.addEventListener('mouseup', function() {
        controlled = false;

        if(angularVelocity > MAX_ANGULAR_VELOCITY) {
            angularVelocity = MAX_ANGULAR_VELOCITY;
        }
        else if(angularVelocity < -1 * MAX_ANGULAR_VELOCITY) {
            angularVelocity = -1 * MAX_ANGULAR_VELOCITY;
        }

        angularVelocities = [];
    }, false);

    document.body.addEventListener('mousemove', function(evt) {
        var mousePos = stage.getPointerPosition();
        if(controlled && mousePos && target) {
            var x1 = mousePos.x - wheel.x();
            var y1 = mousePos.y - wheel.y();
            var x2 = startX - wheel.x();
            var y2 = startY - wheel.y();
            var angle1 = Math.atan(y1 / x1) * 180 / Math.PI;
            var angle2 = Math.atan(y2 / x2) * 180 / Math.PI;
            var angleDiff = angle2 - angle1;

            if ((x1 < 0 && x2 >=0) || (x2 < 0 && x1 >=0)) {
                angleDiff += 180;
            }

            wheel.setRotation(startRotation - angleDiff);
        }
    }, false);
}

function setActiveWedge(n)
{
    var diff = Math.abs(n - activeWedge.identifier);
    var angleDiff = wheel.getRotation() + 360/NUM_WEDGES*diff;
    if(activeWedge.identifier < n){
        angleDiff = wheel.getRotation() - 360/NUM_WEDGES*diff;
    }

    var exponential = Math.floor(angleDiff / (360/NUM_WEDGES));
    var alpha1 = exponential * (360/NUM_WEDGES);
    var alpha2 = (exponential + 1) * (360/NUM_WEDGES);
    angleDiff = (alpha1 + alpha2)/2;

    var tween = new Kinetic.Tween({
        node : wheel,
        rotation : angleDiff,
        duration: 1,
        onFinish:function(){
            this.destroy();
            clickSlider = false;
        }
    });
    tween.play();
}

function addWedge(n) {
    var angle = 360 / NUM_WEDGES;

    var wedge = new Kinetic.Group({
        rotation: n * 360 / NUM_WEDGES
    });

    var wedgeBackground = new Kinetic.Wedge({
        radius: WHEEL_RADIUS - BORDER_OUTSIDE,
        angle: angle,
        fill: BACKGROUND_NORMAL,
        stroke: 'white',
        strokeWidth: 7,
        rotation: (90 + angle/2) * -1
    });
    wedgeBackground.identifier = n;

    wedge.add(wedgeBackground);
    wedgeBackgroundList.push(wedgeBackground);

    var text = new Kinetic.Text({
        text: DATA_WHEEL[n].text,
        x: 0,
        y: (-(WHEEL_RADIUS + IMG_HEIGHT/2)/2),
        fontFamily: 'Archivo, sans-serif',
        fontSize: FONT_SIZE,
        fill: 'white',
        listening: false,
        rotation: -egdeText,
        align: 'center'
    });

    text.offsetX(text.width()/2);
    text.offsetY(text.height()/2);

    wedge.add(text);
    textList.push(text);

    wheel.add(wedge);

    egdeText += angle;
}

function animate(frame) {
    // wheel
    var angularVelocityChange = angularVelocity * frame.timeDiff * (1 - ANGULAR_FRICTION) / 1000;
    angularVelocity -= angularVelocityChange;
    if(controlled) {
        angularVelocity = ((wheel.getRotation() - lastRotation) * 1000 / frame.timeDiff);
    }
    else {
        wheel.rotate(frame.timeDiff * angularVelocity / 1000);
    }
    lastRotation = wheel.getRotation();
    for(var index in textList)
    {
        var tween = new Kinetic.Tween({
            node : textList[index],
            rotation : -(textList[index].parent.parent.attrs.rotation + (360/NUM_WEDGES)*index),
            duration: 0.1,
            onFinish:function(){
                this.destroy();
            }
        });
        tween.play();
    }

    // pointer
    var intersectedWedge = layer.getIntersection({x: WHEEL_RADIUS*2-15, y: WHEEL_RADIUS});

    if (intersectedWedge && (!activeWedge || activeWedge._id !== intersectedWedge._id)) {
        activeWedge = intersectedWedge;

        imageObj.src = DATA_WHEEL[activeWedge.identifier].image;

        for(var index in wedgeBackgroundList)
        {
            wedgeBackgroundList[index].fill(BACKGROUND_NORMAL);
        }
        activeWedge.fill(BACKGROUND_ACTIVE);

        for(var index in textList)
        {
            textList[index].fontStyle('normal');
        }
        activeWedge.parent.children[1].fontStyle('bold');
        if(!clickSlider) {
            wheelSlider.slide(activeWedge.identifier);
        }
    }


}
function init() {
    if (typeof DATA_WHEEL == 'undefined')
        return;
    NUM_WEDGES = DATA_WHEEL.length;

    stage = new Kinetic.Stage({
        container: ID_CONTAINER,
        width: WHEEL_RADIUS*2,
        height: WHEEL_RADIUS*2
    });
    layer = new Kinetic.Layer();
    wheel = new Kinetic.Group({
        x: stage.getWidth() / 2,
        y: WHEEL_RADIUS
    });

    for(var n = 0; n < NUM_WEDGES; n++) {
        addWedge(n);
    }

    var center = new Kinetic.Circle({
        x: WHEEL_RADIUS,
        y: WHEEL_RADIUS,
        radius: IMG_WIDTH/2 + 10,
        fill: 'white'
    });

    var background = new Kinetic.Circle({
        x: WHEEL_RADIUS,
        y: WHEEL_RADIUS,
        radius: WHEEL_RADIUS,
        fill: 'white'
    });

    var pointer = new Kinetic.Circle({
        x: WHEEL_RADIUS*2-5,
        y: WHEEL_RADIUS,
        radius: 5,
        fill: 'white'
    });

    // add components to the stage
    layer.add(background);
    layer.add(wheel);
    layer.add(center);
    layer.add(pointer);

    imageObj = new Image();
    imageObj.onload = function() {
        var yoda = new Kinetic.Image({
            x: WHEEL_RADIUS - IMG_WIDTH/2,
            y: WHEEL_RADIUS - IMG_HEIGHT/2,
            image: imageObj,
            width: IMG_WIDTH,
            height: IMG_HEIGHT
        });

        // add the shape to the layer
        layer.add(yoda);
    };
    imageObj.src = DATA_WHEEL[0].image;

    stage.add(layer);

/*
    var radiusPlus2 = WHEEL_RADIUS + 2;

    wheel.cache({
        x: -1* radiusPlus2,
        y: -1* radiusPlus2,
        width: radiusPlus2 * 2,
        height: radiusPlus2 * 2
    }).offset({
            x: radiusPlus2,
            y: radiusPlus2
        });
*/
    layer.draw();

    // bind events
    bind();

    var anim = new Kinetic.Animation(animate, layer);

    // wait one second and then spin the wheel
    //setTimeout(function() {
        anim.start();
    //}, 1000);
}
$(document).ready(function(){
    var wow = $(window).width();
    var wheelPagi = $('.wheel-pagination');

    $.each(DATA_WHEEL, function(i, v){
        wheelPagi.append('<a href="javascript:;" rel="'+i+'" onclick="wheelSlider.slide('+(i)+');">'+(i+1)+'</a>');
    });

    wheelSlider = Swipe(document.getElementById('wheelSlider'),{
        callback: function(index, elem) {
            wheelPagi.children('.active').removeClass('active');
            wheelPagi.children('a[rel="'+index+'"]').addClass('active');
        }
    });

    wheelPagi.on('click touchend', 'a', function () {
        clickSlider = true;
        setActiveWedge(parseInt($(this).prop('rel'), 10));
    });

    $(window).on('load resize', function(){
        var elements = $(".wheel-slide-content .wpb_content_element");
        var maxHeight = Math.max.apply(null, elements.map(function ()
        {
            return $(this).height();
        }).get());
        elements.height(maxHeight);
    });

    init();
});