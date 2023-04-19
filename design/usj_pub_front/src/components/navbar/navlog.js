import styles from './Nav.module.scss'

function Navlog(){
    return(
        <>
        <nav className='container'>
          <div className='row'>
          <div className='col-4'>
            <div className={styles.logo} ><h1>Logo.</h1></div>
          </div>
          <div className='col-8'>
            <div className={styles.navmenu}>
              <ul>
                
                <li>Login</li>
                <li>Join Free</li>
              </ul>
            </div>
          </div>
          </div>
          
      </nav>
        </>
    )
}

export default Navlog;