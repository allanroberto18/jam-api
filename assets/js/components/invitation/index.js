import React, {Component} from 'react';

class Invitation extends Component {

	constructor(props) {
		super(props);

		this.state = {
			invitationSent: [],
			invitationReceived: []
		}
	}

	componentDidMount() {
		const { id } = this.props.match.params;

		this.invitationsSent(id);
		this.invitationsReceived(id);
	}

	invitationsSent(id) {
		fetch('http://127.0.0.1:8000/api/invitations/sender/' + id)
			.then(response => response.json())
			.then(invitationSent => {
				this.setState({
					invitationSent: invitationSent
				});
			});
	}

	invitationsReceived(id) {
		fetch('http://127.0.0.1:8000/api/invitations/invited/' + id)
			.then(response => response.json())
			.then(invitationReceived => {
				this.setState({
					invitationReceived: invitationReceived
				});
			});
	}

	updateState(id, state) {
		fetch('http://127.0.0.1:8000/api/invitations/' + id, {
			method: 'put',
			headers: { 'Content-Type': 'application/json'},
			body: JSON.stringify({ 'state': state })
		}).then(response => { console.log(status, response.status)});
		;
	}

	mountState(state) {
		switch (state) {
			case 0:
				return <span className="badge badge-warning">Waiting</span>;
			case 1:
				return <span className="badge badge-success">Accepted</span>;
			case 2:
				return <span className="badge badge-secondary">Refused</span>;
			default:
				return <span className="badge badge-pill badge-dark">Undefined</span>;
		}
	}

	mountInvitationSent(id) {
		if (this.state.invitationSent.length > 0) {
			return (
				<table className={"mt-3 table"}>
					<thead>
					<tr>
						<th width={"50%"}>Invitation Sent</th>
						<th width={"50%"}>state</th>
					</tr>
					</thead>
					<tbody>
					{this.state.invitationSent.map(
						({ id, userInvited, state }) => (
							<tr key={ id }>
								<td>{ userInvited.userName }</td>
								<td>{ this.mountState(state) }</td>
							</tr>
						)
					)}
					</tbody>
				</table>
			);
		}
	}

	mountInvitationReceived(id) {
		if (this.state.invitationReceived.length > 0) {
			return (
				<table className={"mt-3 table"}>
					<thead>
					<tr>
						<th width={"50%"}>Invitation Received</th>
						<th width={"30%"}>state</th>
						<th width={"20%"}>option</th>
					</tr>
					</thead>
					<tbody>
					{this.state.invitationReceived.map(
						({id, userSender, state}) => (
							<tr key={id}>
								<td>{userSender.userName}</td>
								<td>{this.mountState(state)}</td>
								<td>
									<div className="btn-group" role="group" aria-label="Basic example">
										<button type="button" className="btn btn-secondary" onClick={() => this.updateState(id, 1)}>Accept
										</button>
										<button type="button" className="btn btn-secondary" onClick={() => this.updateState(id, 2)}>Refuse
										</button>
									</div>
								</td>
							</tr>
						)
					)}
					</tbody>
				</table>
			);
		}
	}

	render() {
		const { id } = this.props.match.params;
		return (
			<div>
				<div>{this.mountInvitationSent(id)}</div>
				<div>
					{this.mountInvitationReceived(id)}
				</div>
			</div>

		);
	}
}
export default Invitation;
