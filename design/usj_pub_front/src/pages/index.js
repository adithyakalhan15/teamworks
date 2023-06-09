import Head from 'next/head'
import { Inter } from 'next/font/google'
import Nav from 'react-router-dom/components/navbar/Nav'
import styles from './home.module.scss'
import Footer from 'react-router-dom/components/footer/Footer'

const inter = Inter({ subsets: ['latin'] })

export default function Home() {
  return (
    <>
      <Head>
        <title>USJ Publications</title>
        <meta name="description" content="This is the preposed design for USJ Publications." />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <Nav/>
      <main>
        <section style={{marginTop:"5%",marginBottom:"7%"}}>
          <div className='row g-0'>
            <div className='col'>
              <img src='/pub_imgs/section1_image.jpg' alt='image1' style={{width:"100%"}}/>
            </div>
            <div className='col'>
              <div className={styles.section1_side}>
                <h3>Welcome to the USJ Publication.</h3>
                <p>Here you can refers to the research documents and documentries related to the Engineering</p>
                <button>Join Now</button>
              </div>
            </div>
          </div>
        </section>
        <section className={styles.search_section}>
          <h2>Search Your Favourite Topics Here.</h2>
          <input type='text' placeholder='Search'></input>
        </section>
        <section style={styles.section2}>
          <div className='container'>
            <div className={styles.section2_all}>
              <h2>Our Resource Categories</h2>
              <p>You can refer different documents, books, audio, videos related to the following areas.</p>
              <div className={styles.section2_btnarea}>
                <div className='row'>
                  <button className='col-3'>Electrical Engineering</button>
                  <button className='col-3'>Electronic Engineering</button>
                  <button className='col-3'>Mechanical Engineering</button>
                  <button className='col-2'>Civil Engineering</button>
                  <button className='col-3'>Computer Engineering</button>
                  <button className='col-3'>Automobile Engineering</button>
                </div>
              </div>
            </div>
          </div>
        </section>
        <Footer/>
      </main>
    </>
  )
}
