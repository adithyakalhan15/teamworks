// import { useState } from 'react';
// import React from 'react';
// import data from './list.js';
// import './search.module.scss';

// function Post({posts}){

//     return(
//         <div>
//             {posts.map((post) => (
//             <div className="container" key={post.id}>
//                 <div className="row">
//                     <div className="col-4">
//                         <img src={post.img} alt="image" />
//                     </div>
//                     <div className="col-8">
//                         <h3>{post.title}</h3>
//                         <p>{post.auth}</p>
//                         <p>{post.date}</p>
//                         <p>{post.disp}</p>
//                     </div>
//                 </div>
//             </div>
//     ))}
//         </div>
//     )
// }

// export async function getStaticProps(){
    

//     setposts(data);

//     return{
//         props:{
//             posts:data,
//         }
//     }
// }

// export default Post;

import React from 'react';
import data from './list.js';
import './search.module.scss';

function Post({ posts }) {
  return (
    <div>
      {posts.map((post) => (
        <div className="container" key={post.id}>
          <div className="row">
            <div className="col-4">
              <img src={post.img} alt="image" />
            </div>
            <div className="col-8">
              <h3>{post.title}</h3>
              <p>{post.auth}</p>
              <p>{post.date}</p>
              <p>{post.disp}</p>
            </div>
          </div>
        </div>
      ))}
    </div>
  );
}

export async function getStaticProps() {
  return {
    props: {
      posts: data,
    },
  };
}

export default Post;