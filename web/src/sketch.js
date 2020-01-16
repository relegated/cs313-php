let pointerAlive = true;
let mine;
let timeOfDeath;

function preload() {
    mineImage = loadImage('images/mine.png');
    explosionImage = loadImage('images/explosion.png');
    graveImage = loadImage('images/grave.png');
}

function setup() {
    createCanvas(windowWidth - 10, windowHeight - 40);
    background(200);
    stroke(0);
    noFill();
    textSize(10);
    textAlign(CENTER);
    mine = new Mine(windowHeight - 40, 0, mineImage);
}

function draw() {
    background(255);

    if (pointerAlive) {
        cursor(ARROW);
        mine.Update(mouseX, mouseY, pointerAlive); 
        
        if (mine.CheckCollision(mouseX, mouseY)) {
            pointerAlive = false;
            timeOfDeath = document.getElementById('phpText').innerHTML;
        }   

        image(mineImage, mine.position.x, mine.position.y);
    }
    else {
        noCursor();
        mine.Update(mouseX, mouseY, pointerAlive);

        if (mine.explosionFrames > 0) {
            image(explosionImage, mine.position.x, mine.position.y);
        }
        else {
            image(graveImage, mine.position.x, mine.position.y);
            text(timeOfDeath, mine.position.x + 30, mine.position.y + 28, 30, 60);
        }
    }

    

}