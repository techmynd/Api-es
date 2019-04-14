document.addEventListener("DOMContentLoaded", function(event) {
  // console.log("DOM Loaded");
  processForm();
});

window.addEventListener("load", function(event) {
  // console.log("Window loaded");
});

const form = document.querySelector('#search-form');
const searchField = document.querySelector('#search-keyword');
let searchedForText;
const responseContainer = document.querySelector('#response-container');
const responseContainerArticles  = document.querySelector('#response-container-articles');

function processForm(){
 
  form.addEventListener('submit', function(e){
    e.preventDefault();


    searchedForText = searchField.value;
    responseContainer.innerHTML = '';
    responseContainerArticles.innerHTML = '';


    // request one image from unsplash
    const imgRequest = new XMLHttpRequest();
    imgRequest.open('GET', `https://api.unsplash.com/search/photos?page=1&query=${searchedForText}`);
    imgRequest.setRequestHeader('Authorization', 'Client-ID 26810b153856944bdaa0c30e4a8bb4c390245f08858cbcb0ecf0520f43bdd5aa');
    imgRequest .send();
    imgRequest.onload = addImage;
    imgRequest.oneror = function (err){
      requestError(err, 'image');
    };
        


    // request articles from nytimes
    const articleRequest = new XMLHttpRequest();
    articleRequest.open('GET', `https://api.nytimes.com/svc/search/v2/articlesearch.json?q=${searchedForText}&api-key=1gyex66s6tXxYUDLwwFSA5oh5A0ALN7u`);
    articleRequest.send();
    articleRequest.onload = addArticles;
    articleRequest.oneror = function (err){
      requestError(err, 'articles');
    };


    
  });
}





function addImage(){
  let htmlContent = '';
  searchedForText = searchField.value;
  responseContainer.innerHTML = '';

  const data = JSON.parse(this.responseText);
  
  // console.log(this.responseText);
  // console.log("image Results ///// ", data.results);
  
  if (data && data.results && data.results[0]) {
    const firstImage = data.results[0];
    htmlContent = `
    <div><img src="${firstImage.urls.regular}"</div>
    <div>${searchedForText} by ${firstImage.user.name}</div>
    `
  } else {
    htmlContent = `Sorry, no images available for '<strong>${searchedForText}</strong>'`;
  }
  responseContainer.insertAdjacentHTML('afterbegin', htmlContent);
}





function addArticles(){
  let htmlContent = '';
  searchedForText = searchField.value;
  responseContainerArticles.innerHTML = '';
  const data = JSON.parse(this.responseText);
  
  //console.log("Article Results ///// ", data.response.docs);
  
  if (data.response && data.response.docs && data.response.docs.length > 1) {
    htmlContent = `<div>Articles from Keyword ${searchedForText}</div><br>` + 
    '<ul>' + data.response.docs.map(article => 
      `<li>
        <h4><a href="${article.web_url}">${article.headline.main}</a></h4>
        <p>${article.snippet}</p>
      </li>`
      ).join('') + '</ul>';
  } else {
    htmlContent = `Sorry, no articles available for '<strong>${searchedForText}</strong>'`;
  }
  responseContainerArticles.insertAdjacentHTML('afterbegin', htmlContent);
}
