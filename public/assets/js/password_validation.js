//Validate New password
            function validatepass ( input ){
                const oldPass = document.querySelector("#cur-pass").value;
                console.log(oldPass, input);
                const newPassError = document.querySelector( ".newPass .error" );
                var passRegx = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
                if ( oldPass === input ){
                    console.log( "entered" );
                    newPassError.classList.add( "error-visible" );
                    newPassError.classList.remove( "error-hidden" );
                    newPassError.innerText = "Old password and new password cannot be same";
                    newError = false;
                    subBtn.style.marginTop = "0px";
                } else if ( input.length == 0 ){
                    newPassError.classList.add( "error-visible" );
                    newPassError.classList.remove( "error-hidden" );
                    newPassError.innerText = "Field cannot be blank";
                    newError = false;
                    subBtn.style.marginTop = "0px";
                } else if ( input.match( passRegx ) ){
                    newPassError.classList.add( "error-hidden" );
                    newPassError.classList.remove( "error-visible" );
                    newError = true;
                    subBtn.style.marginTop = "0px";
                }else{
                    newPassError.classList.add( "error-visible" );
                    newPassError.classList.remove( "error-hidden" );
                    newPassError.innerText = "Password must be a minimum of 8 characters including number, Upper, Lower And one special character";
                    subBtn.style.marginTop = "12px";
                    newError = false;
                }
            }

            //Button State
            const subForm = document.querySelector( "#cp-form" );
            subForm.addEventListener( "keyup",() =>{
                if ( curError == true && newError == true ){
                    subBtn.classList.remove( "disabled" );
                } else{
                    subBtn.classList.add( "disabled" );
                }
            } );