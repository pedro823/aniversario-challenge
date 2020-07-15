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
  return num.toLocaleString(undefined, {minimumIntegerDigits: 2});
}

let isBombActiveCache = null;
function isBombActive() {
  if (isBombActiveCache !== null) {
    return isBombActiveCache;
  }

  return fetch('/is_active.php').then(res => res.json()).then(res => {
    isBombActiveCache = res;
    return res;
  }).catch(err => {
    console.error('Could not fetch is_active, assuming bomb is active');
    console.error({err});
    return true;
  });
}

function countdownTimer(element) {
  const timeFunc = () => {
    const t = getDeadline();
    element.innerHTML = twoDigitNumber(t.days) + 
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

function defusedTimer(element) {
  let defusedClock = document.createElement('div');
  defusedClock.innerHTML = 'DEFUSED';
  defusedClock.setAttribute('class', 'defused');
  element.appendChild(defusedClock);
}

function initializeClock(id) {
  const clock = document.getElementById(id);
  isBombActive().then(res => {
    if (res) {
      return countdownTimer(clock);
    }
    return defusedTimer(clock);
  });
}

initializeClock('clockdiv');
})();