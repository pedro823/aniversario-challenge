(function(){

function getDeadline() {
    const deadline = '2020-07-19';
    const total = Date.parse(deadline) - Date.parse(new Date());
    const seconds = Math.floor( (total/1000) % 60 );
    const minutes = Math.floor( (total/(1000*60)) % 60 );
    const hours = Math.floor( (total/(1000*60*60)) % 24 );
    const days = Math.floor( total/(1000*60*60*24) );

    return {
        total,
        days,
        hours,
        minutes,
        seconds
    };
};

function twoDigitNumber(num) {
  return num.toLocaleString(undefined, {minimumIntegerDigits: 2})
}

function initializeClock(id) {
    const clock = document.getElementById(id);
    const timeFunc = () => {
      const t = getDeadline();
      clock.innerHTML = twoDigitNumber(t.days) + 
                        ':' + twoDigitNumber(t.hours) + 
                        ':' + twoDigitNumber(t.minutes) + 
                        ':' + twoDigitNumber(t.seconds);
      if (t.total <= 0) {
        clearInterval(timeinterval);
      }
    }
    timeFunc();
    const timeinterval = setInterval(timeFunc, 1000);
}

initializeClock('clockdiv');
})();