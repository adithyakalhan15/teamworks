import Head from "next/head";
import React from "react";
import Nav from "react-router-dom/components/navbar/Nav";
import Navlog from "react-router-dom/components/navbar/navlog";
import styles from './search.module.scss';
import results from './list.js';
import Post from "./results";
import resulting from "./list.js";
import Footer from "react-router-dom/components/footer/Footer";


export default function SearchResult(){
    return(
        <>
        <Head>
            <title>Search</title>
        </Head>
        <Navlog/>
        <main className={styles.main}>
            <div className="container">
                <div className="row">
                    <div className="col-4">
                        <div className={styles.filter}>
                            <h2>Filter</h2>
                            <select>
                                <option value="0">Filter by date</option>
                                <option value="1">Accending</option>
                                <option value="2">Decending</option>
                            </select><br/>
                            <select>
                                <option value="0">Filter by category</option>
                                <option value="1">Electronic</option>
                                <option value="2">Mechanical</option>
                                <option value="3">Civil</option>
                                <option value="4">Computer</option>
                            </select><br/>
                            <select>
                                <option value="0">Filter by rating</option>
                                <option value="1">1 star</option>
                                <option value="2">2 star</option>
                                <option value="3">3 star</option>
                                <option value="4">4 star</option>
                                <option value="5">5 star</option>
                            </select>

                        </div>
                    </div>
                    <div className="col-8">
                        <div className={styles.resultarea}>
                            {resulting.map((post)=>{
                                console.log(resulting[0].img)
                                return(
                                <div key={post.id} className={styles.postarea}>
                                    <div className="row">
                                    <div className="col-4">
                                        <img src={post.img} alt="image" width="100%"/>
                                    </div>
                                    <div className="col-8">
                                        <h3>{post.title}</h3>
                                        <p>Authors : {post.auth}<span style={{paddingLeft:"50px"}}>{post.date}</span></p>
                                        <p>{post.disp}</p>
                                        <div>
                                        {post.tags.map((tag)=>{
                                            return(
                                                <span className={styles.tag} >{tag}</span>
                                            )
                                        })}
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            )})}
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <Footer/>
        </>
    )
}