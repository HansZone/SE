%% This function is to train SVM model. 

function [o3]=svm_train

% Clear existing variables
clear

% Load train data 
train_data

% Construct SVM input data
train_input = data([X1; X2; X3; X4], [Y1; Y2; Y3; Y4]);

% Set the parameters of SVM model and train.
k  = kernel('rbf',5);
o1 = one_vs_rest(svm({k}));
o2  = group({o1 ,knn(k),knn('k=3')});
o3  = cv(o2,'folds=5'); 
[r o3] = train(o3,train_input);

clear X1 X2 X3 X4 Y1 Y2 Y3 train_input o1 o2 r 

end