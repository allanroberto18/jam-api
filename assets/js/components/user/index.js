import React from 'react';

const User = ({ id, userName, email }) => (
	<div key={id} className="card col-md-4" style={{width:200}}>
		<div className="card-body">
			<p>{id}</p>
			<h4 className="card-title">{userName}</h4>
			<p className="card-text">{email}</p>
			<a href="" className="btn btn-primary">check invitations</a>
		</div>
	</div>
);

export default User;
