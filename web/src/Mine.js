function Mine(startX, startY, image){
    this.explosionFrames = 50;
    this.position = createVector(startX, startY);
    this.graphics = image;
    this.velocity = createVector(0, 0);
    this.angle = 0;

    this.Update = function(cursorX, cursorY, stillAlive) {
       if (stillAlive) {
        this.angle = Math.atan2((this.position.y - cursorY), (this.position.x - cursorX));
        this.velocity.x = -1 * Math.cos(this.angle);
        this.velocity.y = -1 * Math.sin(this.angle);

        this.position.add(this.velocity);

       }
       else if (this.explosionFrames > 0){
        //rotate(1);
        this.explosionFrames -= 1;
       }
    }

    this.CheckCollision = function(cursorX, cursorY) {
        return (dist(this.position.x + 50, this.position.y + 50, cursorX, cursorY) <= 55);
    }
}