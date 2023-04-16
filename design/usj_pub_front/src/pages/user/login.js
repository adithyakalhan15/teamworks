import Head from "next/head";
import styles from "./user.module.scss"
import { Main } from "next/document";
import Navlog from "react-router-dom/components/navbar/navlog";
import Footer from "react-router-dom/components/footer/Footer";

export default function Login(){
    return(
        <>
        <Head>
            <title>Login</title>
        </Head>
        <main className={styles.main}>
            <Navlog/>
            <div className="container">
                <h2 style={{textAlign:"center", fontWeight:"400"}}>Login</h2>
                <form>
                    <label>Email / Username</label><br/>
                    <input type="text"></input><br/>
                    <label>Password</label><br/>
                    <input type="password"></input><br/>
                    <button type="submit">Login</button>
                    <a href="#">Forgot Password</a>
                </form>
                <div className={styles.join_area}>
                    <div>
                        <p>New to here. <span><button>Join</button></span> with us</p>
                    </div>
                </div>
            </div>
            <Footer/>
        </main>
        </>
    )
}