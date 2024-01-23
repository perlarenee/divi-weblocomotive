// External Dependencies
import React, { Component ,Fragment} from 'react';

// Internal Dependencies
import './style.css';

class Slider extends Component {

  static slug = 'et_pb_diwe_slider';

  _setWrappers(){
    //modifying wrapper classes for layout purposes. this is greedy and messy and i don't like it, but since I don't see a better way to accomplish this yet. I'll come back to it. 
 
    const children = this.props.content;
    const changedObj = children;
    let i = 0;
    while(i<children.length){
      let child = children[i];
      let address = child.props.address;
      let position = child.props.attrs.position;
      let fit = child.props.attrs.fit;
      let item = document.querySelector('.et_pb_diwe_slider_item[data-address="'+address+'"]');
      if(item){
        item.classList.add('fit-'+fit,'pos-'+position);
        let itemWrap = document.querySelector('.et_pb_diwe_slider_item[data-address="'+address+'"] .image');

        //check for slider int suffix
        if(!!this.props.slide_height){
          if(/(%|px|em)$/g.test(this.props.slide_height)){
            itemWrap.style.height=this.props.slide_height+"px";
          }

        }

        
      }
      i++;
    }
    this.props.content = changedObj;
  };
  
  componentDidUpdate(){
    this._setWrappers();
  }

  render() {
    var props = this.props;
    var countDk = props.count;
    var countTab = props.count_tablet;
    var countMob = props.count_mobile;
    var countAll = countDk+"-"+countTab+"-"+countMob;
    var height = props.slide_height;
    var gutter=props.gutter;

    this._setWrappers();
    const myComponentStyle = {
      height: height+"px",
      gridGap: gutter+"px",
      gridAutoRows: height+"px"
    }
    return (
      <Fragment>
        <h1 className="slider-heading">{this.props.heading}</h1>
        <div className={"diwe-slider mb count-dk"+countDk+" count-tab"+countTab+" count-mob"+countMob+""} style={myComponentStyle}  data-count={countAll} data-height={height} data-countdk={countDk} data-counttab={countTab} data-countmob={countMob} data-gutter={gutter} >{this.props.content}</div>
      </Fragment>
    );
  }
}

export default Slider;



