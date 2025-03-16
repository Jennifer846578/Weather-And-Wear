import sys
import json
import base64
from ClassModelWeather import UserOutfitModel as weather_model
from ClassModelStyle import UserOutfitModelS as style_model
from ClassModelCombination import PredictCombinationScore as combi_model
from PredictScore import PredictorScore as predict
import os
import pickle
import numpy as np

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

if __name__=="__main__":
    encoded_json = sys.argv[1]  # Get Base64-encoded string
    json_data = base64.b64decode(encoded_json).decode("utf-8")  # Decode Base64 to JSON
    clothes = json.loads(json_data)

    encoded_json = sys.argv[2]  # Get Base64-encoded string
    json_data = base64.b64decode(encoded_json).decode("utf-8")  # Decode Base64 to JSON
    request = json.loads(json_data)

    userid=clothes[0]['userid']
    # print(request)
    

    
    # ini style
    new_data1 = {
        "top": "shirt",
        "bottom": "jeans",
        "outer": "coat",
        "styleTop": "vintage",
        "styleBottom":"casual",
        "styleOuter" : "casual",
        "styleUser" : "casual",
        "adjusted_rate" : 1
    }
    # for _ in range(10):  # Tambah contoh yang sama berulang kali agar model benar-benar belajar
    #     user1_modelS.update_online_model(new_data1)

    # ini weather
    weather_data={
        'top':'none',
        'bottom':'none',
        'outer':'none',
        'weather':request['weather'],
    }
    # weather_data_rate={
    #     'top':None,
    #     'bottom':None,
    #     'outer':None,
    #     'weather':request['weather'],
    #     'rating':None,
    # }
    style_data={
        "top": 'none',
        "bottom": 'none',
        "outer": 'none',
        "styleTop": 'none',
        "styleBottom":'none',
        "styleOuter" : 'none',
        "styleUser" : request['style'],
    }
    # style_data_rate={
    #     "top": None,
    #     "bottom": None,
    #     "outer": None,
    #     "styleTop": None,
    #     "styleBottom":None,
    #     "styleOuter" : None,
    #     "styleUser" : request['style'],
    #     "adjusted_rate" : None
    # }
    for x in range(len(clothes)):
        if(clothes[x]['id']==request['idOuter']):
            weather_data['outer']=clothes[x]['category'].lower()
            style_data['outer']=clothes[x]['category'].lower()
            style_data['styleOuter']=clothes[x]['style'].lower()
        if(clothes[x]['id']==request['idTop']):
            weather_data['top']=clothes[x]['category'].lower()
            style_data['top']=clothes[x]['category'].lower()
            style_data['styleTop']=clothes[x]['style'].lower()
        if(clothes[x]['id']==request['idPant']):
            weather_data['bottom']=clothes[x]['category'].lower()
            style_data['bottom']=clothes[x]['category'].lower()
            style_data['styleBottom']=clothes[x]['style'].lower()

    model_C=combi_model(userid)
    model_S=style_model(userid)
    model_W=weather_model(userid)
    predicts=predict(userid)
    C=model_C.predict_score_C(style_data['outer'],style_data['top'],style_data['bottom'])
    W=model_W.predict_outfit_rating(weather_data)
    if(style_data['styleUser']=='all'):
        S=0
        styles=['casual', 'formal', 'sporty', 'streetwear','vintage']
        stylesChosen=None
        for y in range(len(styles)):
            style_data['styleUser']=styles[y]
            Stry=model_S.predict_outfit_rating(style_data)
            if(Stry>S):
                S=Stry
                styleChosen=styles[y]
        style_data['styleUser']=styleChosen
    else:
        S=model_S.predict_outfit_rating(style_data)
    score=predicts.predict_score(C,S,W)
    if(request['rate']==0):
        request['rate']=np.clip(score+0.5,1,5)
    style_data_rate=style_data.copy()
    weather_data_rate=weather_data.copy()
    new_C,new_S,new_W=predicts.update_weights_and_scores(C,S,W,request['rate'])
    model_C.update_score_C(style_data['outer'],style_data['top'],style_data['bottom'],new_C)
    style_data_rate['adjusted_rate']=new_S
    weather_data_rate['rating']=new_W
    for x in range(10):
        model_S.update_online_model(style_data_rate)
    for x in range(10):
        model_W.update_online_model(weather_data_rate)
    # print("ga salah kok")  
    
    recWeight=load_recWeight(userid)
    point_distribution(recWeight,10,np.clip(5-round(score),0,2))
    save_recWeight(recWeight,userid)
    


    
    # S=model_S.predict_outfit_rating(style_data)
    
    


    # test = {
    #     "top" : "shirt",
    #     "bottom" : "jogger",
    #     "outer" : "coat",
    #     "weather" : "clear",
    #     "rating" : 1
    # }


    # for data in test:
    #     user1model.update_online_model(test)

    # print(clothes,request)