import Fstyles from './Footer.module.scss'

function Footer(){
    return(
        <>
            <footer className={Fstyles.footer}>
                <div className='container'>
                    <div className='row'>
                        <div className='col'>
                            <h2 style={{fontSize:"40px", marginBottom:"20px"}}>Logo.</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
</p>
                        </div>
                        <div className='col'>
                            <ul className={Fstyles.list1}>
                                <li>Home</li>
                                <li>Publication</li>
                                <li>About us</li>
                                <li>Terms of service</li>
                            </ul>
                        </div>
                        <div className='col'></div>
                    </div>
                </div>
            </footer>
        </>
    )
}

export default Footer;