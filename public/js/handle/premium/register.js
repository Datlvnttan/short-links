$(document).ready(function(){
    const box_show_premium_package = $(".box-show-premium-package")
    CallApiPremium((data)=>{                      
        data.forEach(premium => {               
         let cycle = premium.upgrade_costs/(premium.upgrade_costs/30 >= 12 ? 365 : 30);
         let type = premium.upgrade_costs/30 >= 12 ? "year" : "month"
            let s = `<div class=" col-xxl-3 col-lg-4 col-sm-6 col-12 p-2">
                        <div class="premium-package box-shadow">
                           <div class="premium-package-header">               
                              <div class="plan-line"></div> 
                              <center class="plan-level"><h3>Level ${premium.level}</h3></center>   
                           </div>
                           <div class="premium-package-body">               
                                 <center><h4 class="plan-price"><span><span class="plan-billing_cycle">${premium.billing_cycle}đ</span></span>                                 
                                 <span class="plan-upgrade_costs">/${cycle.toFixed(2)} ${type}</span></h4></center>
                                 <br>
                                 <div class="box-show-benefit w-100">
                                    <center><b class="plan-benefit-title">Periodic limit:</b></center>
                                    <center class="plan-benefit">${premium.limit_create_custom_link}: limit create custom link</center>                  
                                    <center class="plan-benefit">${premium.limit_create_qrcode}: limit create qrcode</center>
                                    <center class="plan-benefit">link lifespan:${premium.link_lifespan} day</center> 
                                 </div>                                               
                           </div>
                           <div class="box-plan-name">
                              <center><b class="plan-name">
                                 ${premium.premium_name}
                              </b> </center>                
                           </div>
                           <div class="premiun-package-footer">
                              <p class="plan-feature-title"><b>${premium.level==1? "Includes:":"Everything in lower levels, plus:"}</b></p>                              
                           </div>
                           <div class="box-btn-buy">
                              <button type="submit" name="id" value="${premium.id}" class="btn btn-warning w-100 btn-buy">Get Started</button>
                           </div>
                        </div>
                     </div>  `;
            const item_premium = $(s);
            const box_package_footer = item_premium.find(".premiun-package-footer");
            CallApiGetFeatureByFollowPremiumId(premium.id,(features)=>{               
               const box_show = $(`<div style="display:none"></div>`)
               features.forEach(feature=>{                                                
                  if(feature.level)
                  {
                     let element = $(`<h6 class="d-inline-block plan-feature" tabindex="0" data-bs-toggle="popover" data-bs-content="${feature.feature_title}">
                                       <i class='bx bx-check-double'></i>${feature.feature_name}</h6>
                                    </h6><br>`)
                     if(feature.level == premium.level)
                        {                           
                           box_package_footer.append(element);    
                        }
                     else
                        box_show.append(element);                                                             
                     new bootstrap.Popover(element, {
                        trigger: 'hover'
                     })
                     createEventTada(element)                            
                  }                   
               })
               if(premium.level!=1)
               {
                  box_package_footer.append(box_show);   
                  const element_down = $(`<center class="show-full-feature"><i style="font-size:25px" class='bx bx-chevrons-down'></i></center>`);
                  $(this).data("show",false)
                  element_down.click(function(){
                     let show = $(this).data("show");
                     $(this).data("show",!show);
                     $(this).html(`<i style="font-size:25px" class='bx bx-chevrons-${show ? "down":"up"}'></i>`)
                     box_show.slideToggle();
                  })
                  box_package_footer.append(element_down); 
                  createEventTada(element_down)            
               }
               
            })  
            box_show_premium_package.append(item_premium)                
        });
    },(res)=>{
        console.log(res)
    })
})

{/* 
                              <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>
                              <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>                */}