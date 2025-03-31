import React, { useState, useEffect, useRef } from "react";
import './ReviewPopup.css';

function ReviewPopup({hotel, onClose}){
    const [isOpen, setOpenClose] = useState(false);
    const dialogRef = useRef(null);

    function toggleModal(){
        if (isOpen){
            setOpenClose(false);
            dialogRef.current?.close();
        }
        else {
            setOpenClose(true);
            dialogRef.current?.showModal();
        }
    }

    function closeModal(){
        onClose();
        toggleModal();
    }

    useEffect(()=>{
        toggleModal();
    }, [hotel])

    return(
        <dialog ref={dialogRef}>
            <button className="closeBtn" onClick={closeModal}>X</button>
            <div className="dialogContent">
                <div className="ratingWrapper">
                    <div className="ratingAnimation">
                        <p>★</p>
                        <p>★</p>
                        <p>★</p>
                        <p>★</p>
                        <p>★</p>
                    </div>
                    <div className="overallRating">{hotel.rating}</div>
                </div>
                <div className="userReviews">
                    {hotel.userReviews.map((review, index) =>(
                        <div key={index} className='userReviewRow'>
                            <div className="rowWrapper">
                                <p>Name: {review.username}</p>
                                <p>Rating: {review.rating}</p>
                                <p>Comment: {review.comment}</p>
                            </div>
                        </div>  
                    ))}
                </div>
            </div>
        </dialog>  
    ) 
}

export default ReviewPopup;