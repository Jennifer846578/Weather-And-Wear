import sys
import json
import base64
from PredictScore import PredictorScore as predict
import os
import pickle
import pandas as pd
from ClassModelWeather import UserOutfitModel as weather_model
from ClassModelStyle import UserOutfitModelS as style_model
from ClassModelCombination import PredictCombinationScore as combi_model
import numpy as np
import math
import random

from colorsys import rgb_to_hsv


def hex_to_rgb(hex_color):
    hex_color = hex_color.lstrip("#")
    return tuple(int(hex_color[i:i+2], 16) for i in (0, 2, 4))

def color_similarity(color1, color2):
    rgb1 = np.array(hex_to_rgb(color1)) / 255.0
    rgb2 = np.array(hex_to_rgb(color2)) / 255.0
    
    hsv1 = rgb_to_hsv(*rgb1)
    hsv2 = rgb_to_hsv(*rgb2)
    
    hue_diff = min(abs(hsv1[0] - hsv2[0]), 1 - abs(hsv1[0] - hsv2[0]))
    sat_diff = abs(hsv1[1] - hsv2[1])
    val_diff = abs(hsv1[2] - hsv2[2])
    
    similarity = 1 - (0.6 * hue_diff + 0.3 * sat_diff + 0.1 * val_diff)
    return max(0, similarity)

def outfit_color_match(top, top_color, bottom=None, bottom_color=None, outer=None, outer_color=None):
    colors = [(top, top_color)]
    if bottom and bottom_color:
        colors.append((bottom, bottom_color))
    if outer and outer_color:
        colors.append((outer, outer_color))
    
    if len(colors) == 1:
        return 1.0  # Jika hanya satu warna, dianggap cocok
    
    total_score = 0
    comparisons = 0
    for i in range(len(colors)):
        for j in range(i + 1, len(colors)):
            total_score += color_similarity(colors[i][1], colors[j][1])
            comparisons += 1
    
    return total_score / comparisons if comparisons > 0 else 1.0


def distribute_items(point, total_items=5):
    # Step 1: Normalize to 100%
    point = [p + 20 for p in point]  # Increase all values by 20
    total_percentage = sum(point)    # Ensure sum is 100
    # Step 2: Convert to item distribution (without rounding errors)
    allocated = [(p * total_items) // total_percentage for p in point]
    # Step 3: Adjust rounding errors
    diff = total_items - sum(allocated)  # How many items are missing
    if diff > 0:
        # Find indices with the largest remainder when divided by total_items
        remainders = [(p * total_items) % total_percentage for p in point]
        for _ in range(diff):
            max_idx = remainders.index(max(remainders))
            allocated[max_idx] += 1
            remainders[max_idx] = -1  # Avoid selecting the same index again
    return allocated
    
def point_distribution(weight,point,index):
    point = 40 - weight[index] if weight[index] + point > 40 else point
    if(weight[2-int(index/2)*2]-point<0):
        weight[abs(1-index)]-=(point-weight[2-int(index/2)*2])
    weight[2-int(index/2)*2]=np.clip(weight[2-int(index/2)*2]-point,0,40)
    weight[index]+=point

BASE_DIRECTORY = os.path.dirname(os.path.abspath(__file__))  # Get the script's directory
def save_recWeight(data, user):
    file = os.path.join(BASE_DIRECTORY, "recWeight", f"user{'0'*(3-len(str(user)))+str(user)}.pkl")  
    with open(file,"wb") as f:
        pickle.dump(data, f)

def load_recWeight(user):
    file = os.path.join(BASE_DIRECTORY, "recWeight", f"user{'0'*(3-len(str(user)))+str(user)}.pkl")  
    if not os.path.exists(file):
        # with open('Cscores/CscoreTemplate.pkl',"rb") as f:  # Ensure the file is created correctly
        #     return pickle.load(f)
        with open(file, "wb") as f:
            pickle.dump([0,0,40], f)

    with open(file,"rb") as f:
        return pickle.load(f)

if __name__ == "__main__":
    encoded_json = sys.argv[1]  # Get Base64-encoded string
    json_data = base64.b64decode(encoded_json).decode("utf-8")  # Decode Base64 to JSON
    clothes = json.loads(json_data)  # Convert JSON string to Python list

    weather=sys.argv[2]
    style=sys.argv[3]

    userid=clothes[0]['userid']

    outer=[]
    outerId=[]
    top=[]
    topId=[]
    bottom=[]
    bottomId=[]

    dressid=[]
    
    outerCloth=["Blazer","Coat","Hoodie","Jacket","Sweater"]
    topCloth=["Shirt","Dress","TShirt"]
    for x in range(len(clothes)):
        if(clothes[x]['category']=='Dress'):
            dressid.append(clothes[x]['id'])
        elif(clothes[x]['category']=="TShirt"):
            top.append("t-shirt")
            topId.append(clothes[x]['id'])
        elif(clothes[x]['category'] in topCloth):
            top.append(clothes[x]['category'].lower())
            topId.append(clothes[x]['id'])
        elif(clothes[x]['category'] in outerCloth):
            outer.append(clothes[x]['category'].lower())
            outerId.append(clothes[x]['id'])
        else:
            bottom.append(clothes[x]['category'].lower())
            bottomId.append(clothes[x]['id'])
    
    outer.append("none")
    outerId.append(None)
    # bottom.append("none")
    # bottomId.append(None)

    outfits=[]
    outfitsId=[]
    outfitsScore=[]

    for x in range(len(outer)):
        outfit=[]
        outfitId=[]
        outfit.append(outer[x])
        outfitId.append(outerId[x])
        for y in range(len(top)):
            outfit.append(top[y])
            outfitId.append(topId[y])
            for z in range(len(bottom)):
                outfit.append(bottom[z])
                outfitId.append(bottomId[z])
                outfits.append(outfit.copy())
                outfitsId.append(outfitId.copy())
                outfit.pop()
                outfitId.pop()
            outfit.pop()
            outfitId.pop()
        outfit.pop()
        outfitId.pop()
    # print(json.dumps(outfits))
    
    #dress appends
    for x in range(len(dressid)):
        outfits.append(['none','dress','none'])
        outfitsId.append(dressid[x])

    weather_data={
        "top":'none',
        "bottom":'none',
        "outer":'none',
        "weather":sys.argv[2].lower(),
    }
    style_data={
        "top":'none',
        "bottom":'none',
        "outer":'none',
        "styleTop": 'none',
        "styleBottom":'none',
        "styleOuter":'none',
        "styleUser" : sys.argv[3].lower(),
    }
    style_model=style_model(userid)
    weather_model=weather_model(userid)
    combi_model=combi_model(userid)
    predict=predict(userid)
    
    for x in range(len(outfits)):

        #combi data
        outer=outfits[x][0]
        top=outfits[x][1]
        bottom=outfits[x][2]

        #weather data
        weather_data['top']=outfits[x][1]
        weather_data['bottom']=outfits[x][2]
        weather_data['outer']=outfits[x][0]

        #style data
        style_data['top']=outfits[x][1]
        style_data['bottom']=outfits[x][2]
        style_data['outer']=outfits[x][0]
        for y in range(len(clothes)):
            if(clothes[y]['id']==outfitsId[x][0]):
                style_data["styleOuter"]=clothes[y]['style'].lower()
            elif(clothes[y]['id']==outfitsId[x][1]):
                style_data["styleTop"]=clothes[y]['style'].lower()
            elif(clothes[y]['id']==outfitsId[x][2]):
                style_data["styleBottom"]=clothes[y]['style'].lower()
        
        C=combi_model.predict_score_C(outer,top,bottom)
        if(style_data['styleUser']=='all'):
            S=0
            styles=['casual', 'formal', 'sporty', 'streetwear','vintage']
            stylesChosen=None
            for y in range(len(styles)):
                style_data['styleUser']=styles[y]
                Stry=style_model.predict_outfit_rating(style_data)
                if(Stry>S):
                    S=Stry
                    styleChosen=styles[y]
            style_data['styleUser']=styleChosen
        else:
            S=style_model.predict_outfit_rating(style_data)
        W=weather_model.predict_outfit_rating(weather_data)
        
        outfitsScore.append(predict.predict_score(C,S,W))
    
    outfitByRatingId={
        "1":[],
        "2":[],
        "3":[],
        "4":[],
        "5":[],
    }
    
    for x in range(len(outfitsScore)):
        outfitByRatingId[str(round(outfitsScore[x]))].append(outfitsId[x])
    # print(outfitByRatingId)

    
    

    
    

    distribution=load_recWeight(userid)
    distribution=distribute_items(distribution)
    clothdistribution=[len(outfitByRatingId['5']),len(outfitByRatingId['4']),len(outfitByRatingId['3'])+len(outfitByRatingId['2'])+len(outfitByRatingId['1'])]
    for x in range(len(clothdistribution)):
        if(x!=2 and clothdistribution[x]<distribution[x]):
            distribution[x+1]+=distribution[x]-clothdistribution[x]
            distribution[x]-=distribution[x]-clothdistribution[x]
    for x in range(len(clothdistribution)-1,0,-1):
        if(x!=0 and clothdistribution[x]<distribution[x]):
            distribution[x-1]+=distribution[x]-clothdistribution[x]
            distribution[x]-=distribution[x]-clothdistribution[x]
    distribution[0]=min(clothdistribution[0],distribution[0])
    
    outerReturnList=[]
    topReturnList=[]
    botReturnList=[]
    for x in range(len(distribution)):
        for y in range(distribution[x]):
            if(x!=2 and len(outfitByRatingId[str(5-x)])!=0):
                if(len(outfitByRatingId[str(5-x)])==1):
                    index=0
                else:
                    index=random.randint(0,len(outfitByRatingId[str(5-x)])-1)
                outerReturnList.append(outfitByRatingId[str(5-x)][index][0])
                topReturnList.append(outfitByRatingId[str(5-x)][index][1])
                botReturnList.append(outfitByRatingId[str(5-x)][index][2])
                outfitByRatingId[str(5-x)].pop(index)
            else:
                while(1):
                    rating=random.randint(1,3)
                    rating=str(rating)
                    if(len(outfitByRatingId[rating])>0):
                        break
                if(len(outfitByRatingId[rating])==1):
                    index=0
                else:
                    index=random.randint(0,len(outfitByRatingId[rating])-1)
                outerReturnList.append(outfitByRatingId[rating][index][0])
                topReturnList.append(outfitByRatingId[rating][index][1])
                botReturnList.append(outfitByRatingId[rating][index][2])
                outfitByRatingId[rating].pop(index)
    outfitlistreturn=[outerReturnList,topReturnList,botReturnList]

    # print(outfitlistreturn)
    outerlastlistname=[]
    toplastlistname=[]
    bottomlastlistname=[]
    colorouter=[]
    colortop=[]
    colorbottom=[]
    for x in range(len(outfitlistreturn[0])):
        if(outfitlistreturn[0][x]!=None):
            for y in range(len(clothes)):
                if(clothes[y]['id']==outfitlistreturn[0][x]):
                    outerlastlistname.append(clothes[y]['category'])
                    colorouter.append(clothes[y]['color'])
        else:
            outerlastlistname.append(None)
            colorouter.append(None)
        if(outfitlistreturn[2][x]!=None):
            for y in range(len(clothes)):
                if(clothes[y]['id']==outfitlistreturn[2][x]):
                    bottomlastlistname.append(clothes[y]['category'])
                    colorbottom.append(clothes[y]['color'])
        else:
            bottomlastlistname.append(None)
            colorbottom.append(None)
        for y in range(len(clothes)):
            if(clothes[y]['id']==outfitlistreturn[1][x]):
                toplastlistname.append(clothes[y]['category'])
                colortop.append(clothes[y]['color'])

    

    outfitlast=[outerlastlistname,toplastlistname,bottomlastlistname]
    coloroutfit=[colorouter,colortop,colorbottom]
    # print(outfitlast,coloroutfit)
    outfitscolorranks=[]
    for x in range(len(outfitlast[1])):
        outfitsrn=[]
        outfitsrn.append(outfitlast[1][x].lower())
        outfitsrn.append(coloroutfit[1][x])
        if(outfitlast[2][x]!=None):
            outfitsrn.append(outfitlast[2][x].lower())
            outfitsrn.append(coloroutfit[2][x])
        else:
            outfitsrn.append(None)
            outfitsrn.append(None)
        if(outfitlast[0][x]!=None):
            outfitsrn.append(outfitlast[0][x].lower())
            outfitsrn.append(coloroutfit[0][x])
        else:
            outfitsrn.append(None)
            outfitsrn.append(None)
        # print(outfitsrn)
        # print()
        outfitscolorranks.append(outfit_color_match(outfitsrn[0],outfitsrn[1],outfitsrn[2],outfitsrn[3],outfitsrn[4],outfitsrn[5]))
    # print(outfitlistreturn)
    for i in range(len(outfitscolorranks)):
        for j in range(0, len(outfitscolorranks) - i - 1):
            if outfitscolorranks[j] > outfitscolorranks[j + 1]:  # Swap if the element is greater than the next
                outfitscolorranks[j], outfitscolorranks[j + 1] = outfitscolorranks[j + 1], outfitscolorranks[j]
                outfitlistreturn[0][j],outfitlistreturn[0][j+1]=outfitlistreturn[0][j+1],outfitlistreturn[0][j]
    # print(outfitscolorranks)
    # print(outfitlistreturn)

    

        
    print(json.dumps(outfitlistreturn))
        


        



        
        
        
    


    


                
                
            
    
    


    # outerlist=[clothes[0]['id'],None]
    # shirtlist=[clothes[1]['id'],clothes[1]['id']]
    # pantlist=[clothes[2]['id'],clothes[2]['id']]

    # output = {
    #     "outer":outerlist,
    #     'shirt':shirtlist,
    #     "pant":pantlist,
    #     "clothes": clothes,
    #     "weather": weather,
    #     "style": style
    # }

    # print(json.dumps(output)) 