// 1.Flow
async1(function (result) {
  console.log(result)
  async2(function (result) {
    console.log(result)
    async3(function (result) {
      console.log(result)
      async4(function (result) {
        console.log(result)
        async5(function (result) {
          console.log(result)
        });
      });
    });
  });
});

// //PHP-->>>>
// async1(result => console.log(result)); // รอ 1
// async2(result => console.log(result)); // รอ 2    
// async3(result => console.log(result));
// async4(result => console.log(result));
// async5(result => console.log(result));



function async1(cb) {
  setTimeout(function () {
    cb(1)
  }, 1000)
}

function async2(cb) {
  setTimeout(function () {
    cb(2)
  }, 1000)
}

function async3(cb) {
  setTimeout(function () {
    cb(3)
  }, 1000)
}

function async4(cb) {
  setTimeout(function () {
    cb(4)
  }, 1000)
}

function async5(cb) {
  setTimeout(function () {
    cb(5)
  }, 1000)
}