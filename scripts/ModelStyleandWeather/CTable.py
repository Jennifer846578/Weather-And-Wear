import pickle
# outer=["blazer","coat","hoodie","jacket","sweater","none"]
# top=["dress","shirt","t-shirt"]
# bottom=["cargo","jeans","jogger","legging","shorts","skirt","trousers","none"]
# outfit=[None,None,None,3]
# for i in range(len(outer)):
#     outfit[0]=outer[i]
#     for ii in range(len(top)):
#         outfit[1]=top[ii]
#         for iii in range(len(bottom)):
#             outfit[2]=bottom[iii]
#             print(outfit,',')

outfits=[
    ['blazer', 'dress', 'cargo', 3] ,
    ['blazer', 'dress', 'jeans', 3] ,
    ['blazer', 'dress', 'jogger', 3] ,
    ['blazer', 'dress', 'legging', 3] ,
    ['blazer', 'dress', 'shorts', 3] ,
    ['blazer', 'dress', 'skirt', 3] ,
    ['blazer', 'dress', 'trousers', 3] ,
    ['blazer', 'dress', 'none', 3] ,
    ['blazer', 'shirt', 'cargo', 3] ,
    ['blazer', 'shirt', 'jeans', 3] ,
    ['blazer', 'shirt', 'jogger', 3] ,
    ['blazer', 'shirt', 'legging', 3] ,
    ['blazer', 'shirt', 'shorts', 3] ,
    ['blazer', 'shirt', 'skirt', 3] ,
    ['blazer', 'shirt', 'trousers', 3] ,
    ['blazer', 'shirt', 'none', 3] ,
    ['blazer', 't-shirt', 'cargo', 3] ,
    ['blazer', 't-shirt', 'jeans', 3] ,
    ['blazer', 't-shirt', 'jogger', 3] ,
    ['blazer', 't-shirt', 'legging', 3] ,
    ['blazer', 't-shirt', 'shorts', 3] ,
    ['blazer', 't-shirt', 'skirt', 3] ,
    ['blazer', 't-shirt', 'trousers', 3] ,
    ['blazer', 't-shirt', 'none', 3] ,
    ['coat', 'dress', 'cargo', 3] ,
    ['coat', 'dress', 'jeans', 3] ,
    ['coat', 'dress', 'jogger', 3] ,
    ['coat', 'dress', 'legging', 3] ,
    ['coat', 'dress', 'shorts', 3] ,
    ['coat', 'dress', 'skirt', 3] ,
    ['coat', 'dress', 'trousers', 3] ,
    ['coat', 'dress', 'none', 3] ,
    ['coat', 'shirt', 'cargo', 3] ,
    ['coat', 'shirt', 'jeans', 3] ,
    ['coat', 'shirt', 'jogger', 3] ,
    ['coat', 'shirt', 'legging', 3] ,
    ['coat', 'shirt', 'shorts', 3] ,
    ['coat', 'shirt', 'skirt', 3] ,
    ['coat', 'shirt', 'trousers', 3] ,
    ['coat', 'shirt', 'none', 3] ,
    ['coat', 't-shirt', 'cargo', 3] ,
    ['coat', 't-shirt', 'jeans', 3] ,
    ['coat', 't-shirt', 'jogger', 3] ,
    ['coat', 't-shirt', 'legging', 3] ,
    ['coat', 't-shirt', 'shorts', 3] ,
    ['coat', 't-shirt', 'skirt', 3] ,
    ['coat', 't-shirt', 'trousers', 3] ,
    ['coat', 't-shirt', 'none', 3] ,
    ['hoodie', 'dress', 'cargo', 3] ,
    ['hoodie', 'dress', 'jeans', 3] ,
    ['hoodie', 'dress', 'jogger', 3] ,
    ['hoodie', 'dress', 'legging', 3] ,
    ['hoodie', 'dress', 'shorts', 3] ,
    ['hoodie', 'dress', 'skirt', 3] ,
    ['hoodie', 'dress', 'trousers', 3] ,
    ['hoodie', 'dress', 'none', 3] ,
    ['hoodie', 'shirt', 'cargo', 3] ,
    ['hoodie', 'shirt', 'jeans', 3] ,
    ['hoodie', 'shirt', 'jogger', 3] ,
    ['hoodie', 'shirt', 'legging', 3] ,
    ['hoodie', 'shirt', 'shorts', 3] ,
    ['hoodie', 'shirt', 'skirt', 3] ,
    ['hoodie', 'shirt', 'trousers', 3] ,
    ['hoodie', 'shirt', 'none', 3] ,
    ['hoodie', 't-shirt', 'cargo', 3] ,
    ['hoodie', 't-shirt', 'jeans', 3] ,
    ['hoodie', 't-shirt', 'jogger', 3] ,
    ['hoodie', 't-shirt', 'legging', 3] ,
    ['hoodie', 't-shirt', 'shorts', 3] ,
    ['hoodie', 't-shirt', 'skirt', 3] ,
    ['hoodie', 't-shirt', 'trousers', 3] ,
    ['hoodie', 't-shirt', 'none', 3] ,
    ['jacket', 'dress', 'cargo', 3] ,
    ['jacket', 'dress', 'jeans', 3] ,
    ['jacket', 'dress', 'jogger', 3] ,
    ['jacket', 'dress', 'legging', 3] ,
    ['jacket', 'dress', 'shorts', 3] ,
    ['jacket', 'dress', 'skirt', 3] ,
    ['jacket', 'dress', 'trousers', 3] ,
    ['jacket', 'dress', 'none', 3] ,
    ['jacket', 'shirt', 'cargo', 3] ,
    ['jacket', 'shirt', 'jeans', 3] ,
    ['jacket', 'shirt', 'jogger', 3] ,
    ['jacket', 'shirt', 'legging', 3] ,
    ['jacket', 'shirt', 'shorts', 3] ,
    ['jacket', 'shirt', 'skirt', 3] ,
    ['jacket', 'shirt', 'trousers', 3] ,
    ['jacket', 'shirt', 'none', 3] ,
    ['jacket', 't-shirt', 'cargo', 3] ,
    ['jacket', 't-shirt', 'jeans', 3] ,
    ['jacket', 't-shirt', 'jogger', 3] ,
    ['jacket', 't-shirt', 'legging', 3] ,
    ['jacket', 't-shirt', 'shorts', 3] ,
    ['jacket', 't-shirt', 'skirt', 3] ,
    ['jacket', 't-shirt', 'trousers', 3] ,
    ['jacket', 't-shirt', 'none', 3] ,
    ['sweater', 'dress', 'cargo', 3] ,
    ['sweater', 'dress', 'jeans', 3] ,
    ['sweater', 'dress', 'jogger', 3] ,
    ['sweater', 'dress', 'legging', 3] ,
    ['sweater', 'dress', 'shorts', 3] ,
    ['sweater', 'dress', 'skirt', 3] ,
    ['sweater', 'dress', 'trousers', 3] ,
    ['sweater', 'dress', 'none', 3] ,
    ['sweater', 'shirt', 'cargo', 3] ,
    ['sweater', 'shirt', 'jeans', 3] ,
    ['sweater', 'shirt', 'jogger', 3] ,
    ['sweater', 'shirt', 'legging', 3] ,
    ['sweater', 'shirt', 'shorts', 3] ,
    ['sweater', 'shirt', 'skirt', 3] ,
    ['sweater', 'shirt', 'trousers', 3] ,
    ['sweater', 'shirt', 'none', 3] ,
    ['sweater', 't-shirt', 'cargo', 3] ,
    ['sweater', 't-shirt', 'jeans', 3] ,
    ['sweater', 't-shirt', 'jogger', 3] ,
    ['sweater', 't-shirt', 'legging', 3] ,
    ['sweater', 't-shirt', 'shorts', 3] ,
    ['sweater', 't-shirt', 'skirt', 3] ,
    ['sweater', 't-shirt', 'trousers', 3] ,
    ['sweater', 't-shirt', 'none', 3] ,
    ['none', 'dress', 'cargo', 3] ,
    ['none', 'dress', 'jeans', 3] ,
    ['none', 'dress', 'jogger', 3] ,
    ['none', 'dress', 'legging', 3] ,
    ['none', 'dress', 'shorts', 3] ,
    ['none', 'dress', 'skirt', 3] ,
    ['none', 'dress', 'trousers', 3] ,
    ['none', 'dress', 'none', 3] ,
    ['none', 'shirt', 'cargo', 3] ,
    ['none', 'shirt', 'jeans', 3] ,
    ['none', 'shirt', 'jogger', 3] ,
    ['none', 'shirt', 'legging', 3] ,
    ['none', 'shirt', 'shorts', 3] ,
    ['none', 'shirt', 'skirt', 3] ,
    ['none', 'shirt', 'trousers', 3] ,
    ['none', 'shirt', 'none', 3] ,
    ['none', 't-shirt', 'cargo', 3] ,
    ['none', 't-shirt', 'jeans', 3] ,
    ['none', 't-shirt', 'jogger', 3] ,
    ['none', 't-shirt', 'legging', 3] ,
    ['none', 't-shirt', 'shorts', 3] ,
    ['none', 't-shirt', 'skirt', 3] ,
    ['none', 't-shirt', 'trousers', 3] ,
    ['none', 't-shirt', 'none', 3] 
]

with open('Cscores/CscoreTemplate.pkl',"wb") as f:
    pickle.dump(outfits,f)

with open('Cscores/CscoreTemplate.pkl',"rb") as f:
    print(pickle.load(f))

            
