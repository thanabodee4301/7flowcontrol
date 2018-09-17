(async function () {
    var result = await async1();
    console.log(result);
    result = await async2();
    console.log(result);
    result = await async3();
    console.log(result);
    result = await async4();
    console.log(result);
    result = await async5();
    console.log(result);
})();

function async1() {
    return new Promise((resolve) => {
        setTimeout(function () {
            resolve(1)
        }, 2000);
    })
}

function async1_nopm(cb) {
    setTimeout(function () {
        cb(1)
    }, 2000);
}



function async2() {
    return new Promise((resolve) => {
        setTimeout(function () {
            resolve(2)
        }, 2000);
    })
}

function async3() {
    return new Promise((resolve) => {
        setTimeout(function () {
            resolve(3)
        }, 2000);
    })
}

function async4(cd) {
    return new Promise((resolve) => {
        setTimeout(function () {
            resolve(4)
        }, 2000);
    })
}

function async5(cd) {
    return new Promise((resolve) => {
        setTimeout(function () {
            resolve(5)
        }, 2000);
    })
}