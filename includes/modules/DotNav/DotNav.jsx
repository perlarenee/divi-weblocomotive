// External Dependencies
import React, { Component ,Fragment} from 'react';

// Internal Dependencies
import './style.css';

class DotNav extends Component {

  static slug = 'et_pb_diwe_dotnav';

  render() {
    return (
      <Fragment>
        <div className="diwe-dotnav"><div className="dotnav-wrapper">{this.props.content}</div></div>
      </Fragment>
    );
  }
}

export default DotNav;